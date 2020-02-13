---
extends: _layouts.post
section: content
title: PHP dotenv in Laravel
date: 2014-01-16
created_at: 2014-01-16T15:55:55.000Z
updated_at: 2014-10-09T00:36:43.000Z
published_at: 2014-01-16T17:06:57.000Z
description: PHP dotenv in Laravel
cover_image: /assets/img/post-cover-image-2.png
---

####EDIT: (2/13/2014)
I just discovered that Taylor has built in [.env file loading](http://laravel.com/docs/configuration#protecting-sensitive-configuration) into core. By adding a file of type `.env.{environment}.php` to the root of your application, it will be autoloaded by Laravel much in the same way that dotenv does. Moving forward, this should be the preferred method of loading environment variables, but the principles of dotenv still apply, and can be used for things other than Laravel.

####EDIT: (10/8/2014)
Taylor has removed his own code for performing the .env file importing and will be utilizing Vance Lucas's PHP dotenv library for this functionality starting in version 5.

---

Managing environments is one of the difficult tasks many developers have to tackle when trying to create and deploy applications. Laravel makes setting up [environment-specific configuration](http://laravel.com/docs/configuration#environment-configuration) pretty easy. Setting different database credentials via this method is extremely easy and makes deployment simple. However, when making a project public or open source (on GitHub for example), you don't want to be showing your production system credentials to the world. 

Many production setups set some sort of environment variables for determining the application environment, such as `RAILS_ENV="production"` or `LARAVEL_ENV="staging"`. Those same environment variables are a great solution to having instance-specific values for things like API Keys. The issue with this solution is that it requires sys-admin intervention when you want to add new information, for that new Iron MQ push queue functionality you just introduced.

Luckily for PHP Devs, [Vance Lucas](http://vancelucas.com/) created the [PHP dotenv](https://github.com/vlucas/phpdotenv) library that can load these variables from a `.env` file. **Remember to add `.env` to your .gitignore or other VCS-ignoring config, otherwise your production credentials can still be available. If you want to include some template file, I recommend a .env.example that shows the variables that need to be defined.**

## Using dotenv with Laravel
dotenv is available for installation through composer, so installation should feel familiar for most of you. Run the following to include the library as a dependency in your Laravel app.

`composer require vlucas/phpdotenv --prefer-dist`

### Loading dotenv
Since the variables defined in our `.env` file are going to be used at varying points throughout the application, we want to ensure that it is loaded as early as possible in our application lifecycle, so the loading will occur in the `app/start` directory of the Laravel app.

The `app/start` directory contains the [start files](http://laravel.com/docs/lifecycle#start-files) that are loaded when Laravel begins execution. We have a few options in how we wish to load the environment variables. The first is including the code in the `global.php` file. This will load the environment variables for **every** environment you run your app in. However, I only wish to run it when in production. Thanks to Laravel, I can create an `{environment}.php` file in `app/start` and it will be loaded when that environment is in use, so I will be creating `production.php`. Use whatever method/file is appropriate for you, the code remains the same.

In the start file, setup begins by telling dotenv to load the `.env` file by providing it the directory that contains the file.

`Dotenv::load(base_path());`

Here, I'm telling dotenv to load the file from the root directory of my Laravel application. You can just as easily put it anywhere else, just make sure to send the directory path as a parameter to the `load` method.

Next, I want to ensure that several variables are available from the `.env` file.

`Dotenv::required(array('DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'));`

This call will check to make sure all of those variables have been loaded. If not, a `RuntimeException` will be thrown.

### Using the Environment Variables
As you can see, I've used dotenv to load variables for my database connection. Getting to these variables is the same as getting other environment and server variables in php.

```
$DB_NAME = getenv('DB_NAME');
$DB_NAME = $_ENV['DB_NAME'];
$DB_NAME = $_SERVER['DB_NAME'];
```

All three methods will work, but I prefer and would recommend the first so you aren't accessing [superglobals](http://www.php.net/manual/en/language.variables.superglobals.php) directly.

Now I can change my production `app/config/database.php` file to load my credentials from the environment variables.

```
'connections' => array(
    'mysql' => array(
        'driver'    => 'mysql',
        'host'      => getenv('DB_HOST'),
        'database'  => getenv('DB_DATABASE'),
        'username'  => getenv('DB_USERNAME'),
        'password'  => getenv('DB_PASSWORD'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ),
),
```

Clean, configurable, readable, and secure. Using this library, you can now make your application source code public, while remaining at ease that your system credentials aren't out in the open. Visit [phpdotenv's documentation](https://github.com/vlucas/phpdotenv) for more about the library and [Laravel's docs](http://laravel.com/docs) about environment configuration, if you wish to learn more.

