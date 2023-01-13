---
extends: _layouts.post
section: content
title: Gotta Start Somewhere
date: 2014-01-16
created_at: 2013-12-30T14:56:09.000Z
updated_at: 2014-01-16T15:29:19.000Z
published_at: 2014-01-16T15:29:19.000Z
description: Gotta Start Somewhere
cover_image: /assets/img/post-cover-image-2.png
---

In an [earlier post](/blog/posts/in-the-beginning), I wrote about my plan to start a solo project that encompasses a wide range of technologies, largely as a learning experience. 

And you've gotta start somewhere. 

First, I had to decide on a language and a framework to use as the building blocks of the Forge. There are a ton of great ways to build a web application these days. Ruby on Rails has been huge over the past five years or so. Node.js has spawned a server-side javascript revolution that has been well received throughout the community. Countless other frameworks, languages, and tools are available for accomplishing what I'm setting out to do. But there has been one framework that has really captured my interests this past year.

### Laravel
Laravel is a PHP framework developed by Taylor Otwell that makes building web applications easy, efficient, and fun. It has really come to renew my interest in working with PHP and introduced me to a great community full of intelligent developers who love to share their knowledge with people like me. It also pulls in some of the best resources from PHP to make a robust and feature rich framework to build applications of all types. If you don't believe me, check out [Built With Laravel](https://builtwithlaravel.com/) to see what Laravel is capable of.

I have used this framework before on several small projects, but nothing substantial. So, because of my interest in exploring the framework and really understanding the potential it has, I've decided to use this as the starting point for Forge.

#### Composer
One of the things that makes Laravel great is that it leverages PHP's package manager [Composer](https://getcomposer.org/). As I said before, Laravel pulls in some of the best resources for PHP, and it does so using Composer. 

Composer was built by Nils Adermann and Jordi Boggiano as a way to share PHP packages efficiently across projects, as well as make depencency management easier for developers. It took its lead from the PHP-FIG's definition of [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) autoloading standards. This allows for developers to easily define a configuration file of all the dependencies in a project and run `composer install` to easily install those dependencies.

Laravel itself, and the components that comprise it, are also available through Composer, which makes it super easy to get started once you have Composer installed.

#### Installation
If composer is installed on your machine, to install Laravel, you just run `composer create-project laravel/laravel --prefer-dist`. This will create a directory for your Laravel project and install all of the required dependencies. Like I said, super easy.

### PHP
Now, going with Laravel as a framework means working in PHP. There have been plenty of posts by people scoffing at the language, but honestly I couldn't care less. PHP is a tool, and it's a tool I am comfortable with and truly enjoy using. It's not the cool kid on the block like node.js is these days, but hey, it'll get the job done. PHP is easy to write, easy to manage, easy to deploy. So when you're just trying to get in there and start **building** something, I'd say there's no language better.


## Next
So, Forge is going to be built with Laravel. Great. Now what?

Well, I need some way to run the project. But being on a Mac and production being an Ubuntu server, I don't really want to run locally. And so, the next step is to mimic production for development.
