---
extends: _layouts.post
section: content
title: The Great Facade
date: 2013-12-11
created_at: 2013-12-10T23:45:45.000Z
updated_at: 2014-01-03T16:32:19.000Z
published_at: 2013-12-11T00:26:53.000Z
description: The Great Facade
cover_image: /assets/img/post-cover-image-2.png
---

Last time, I wrote about the new PHP mocking framework, [AspectMock](/blog/2013/07/24/are-you-mocking-me), which added the ability to test static methods, something that was previously untestable. Also, recently several members of the PHP community got into a heated discussion about the use of statics in the popular PHP framwork Laravel. So I decided to add my two cents to the discussion and post about the **actual** use of statics in Laravel.

I know what you’re saying. “I thought you just told us static methods are hard for testing? Why not use AspectMock if you’re using static methods?”. Well, there is actually a good answer to what Laravel is doing and why it provides static methods to developers.
 
Facades. No, it’s not pronounced fay-kades, it’s fuh-sahds. Facade is an object-oriented pattern popularized by the [Gang of Four](http://en.wikipedia.org/wiki/Design_Patterns) that provides an interface to a large body of code, such as a class library. This design pattern is incredible powerful, and is used extensively in the popular PHP framework, [Laravel](http://laravel.com). By leveraging the Facade Pattern, Taylor Otwell, the framework’s creator, provided developers the ability to use static methods of library classes for an “expressive, elegant syntax”.

 
 Well, that’s why the facade pattern is being used here! In laravel, you’re not calling a static method of a library class. Instead, the method call is for a Facade, which forwards the call to the instantiated library class. This allows us to keep both the elegance of the syntax and keep our code testable. Let me show you how that works.

The following code is the main power behind Laravel's powerful facade structure. It is a PHP magic method that will intercept any static method that is not already defined in the class. It first grabs the underlying class library that has been instantiated in the IOC container or creates an instance of it to use. Then it sends the method called on the facade to the instance to handle. 
```
<?php
/**
* Handle dynamic, static calls to the object.
*
* @param  string  $method
* @param  array   $args
* @return mixed
*/
public static function __callStatic($method, $args)
{
    $instance = static::resolveFacadeInstance(static::getFacadeAccessor());
    
    switch (count($args))
    {
        case 0:
            return $instance->$method();
        
        case 1:
            return $instance->$method($args[0]);
        
        case 2:
            return $instance->$method($args[0], $args[1]);
        
        case 3:
            return $instance->$method($args[0], $args[1], $args[2]);
        
        case 4:
            return $instance->$method($args[0], $args[1], $args[2], $args[3]);
        
        default:
            return call_user_func_array(array($instance, $method), $args);
    }
}
```


Now, let that sink in. It works with a real instantiated object, and isn't just flinging static method calls around all over the place. All of the provided laravel libraries operate as stateful instances of classes, which is not immediately aparent due to the syntax most commonly used in laravel applications. 

So next time you `Mail::send()`, remember that you are actually in fact calling `Illuminate\Mail\Mailer`'s send method on an object in the IOC container.

####Update: 12/12/2013
Taylor has just included a doc page for Laravel's use of Facades on the [Laravel Website](http://laravel.com/docs/facades). I recommend you check it out as it includes a lot of great information about them, including usage, creating your own Facades, mocking Facades for testing, and a reference list of Laravel's built in Facade classes and which implementations they refer to.
