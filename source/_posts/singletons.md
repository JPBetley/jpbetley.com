---
extends: _layouts.post
section: content
title: Singletons
date: 
created_at: 2014-10-25T03:50:34.000Z
updated_at: 2014-10-27T20:51:19.000Z
published_at: 
description: Singletons
cover_image: /assets/img/post-cover-image-2.png
---

I saw an interesting post the other day discussing whether or not Singletons are an anti-pattern. One side argued that Singletons had valid use cases and there's nothing wrong in using them, in fact they were quite useful. The other side was arguing that Singletons lead to sticky code issues, and were nothing more than global variables.

I, oddly, agree with both sides. And the reason for that is the subtle difference between the Singleton Design Pattern and the Singleton Object Lifecycle.
Singleton Design Pattern

The Singleton Design Pattern is a pattern through which a class can only be instantiated once. Below is a simple example of this design pattern in PHP.


```

class Singleton
{
    private static $instance;
    
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
   
    private function __construct() { }
}
```
The combination of the private constructor, the `$instance` variable, and the public `getInstance` method provides only a single avenue for code to interact with this class. We have restricted the ability to instantiate instances, and only delegate a single instance to ever exist of this class. 

While I agree that Singletons are useful in some cases, I firmly believe that the use of the Singleton Design Pattern is in fact an anti-pattern. This is because the class is now responsible for its own lifecycle within the application. This violates the idea of Single Responsibility. By using the Singleton Design Pattern, our class is responsible for two things: its original responsibility and its creation and destruction. In addition, it is widely regarded as best practice that a class should not be responsible for instantiating its own dependencies. So it would naturally follow that a class should also not be responsible for the instantiation of itself.

The issue now is that, while we believe that the Singleton Design Pattern is a poor approach to our problem, how do we create an instance of an object that has the same lifetime of a Singleton. Accomplishing this is what I call the Singleton Object Lifecycle.
Singleton Object Lifecycle

The Singleton Object Lifecycle is ultimately what the use of the Singleton Design Pattern provides to us: an object instance that lasts for the lifetime of the application. If you are practicing dependency inversion in your applications, you should be familiar with the concept of an Inversion of Control and Dependency Injection Containers. If you **aren’t** familiar with these terms, or their uses, you have some [homework](https://fabien.potencier.org/article/11/what-is-dependency-injection) to do.

Using a DI tool, we now have the means to instantiate an object with a Singleton Object Lifecycle that can be used in other classes as a dependency.

Here’s an example of this in Laravel:
```
App::singleton('Foo', function()
{
    return new Foo;
});

class Bar 
{
    public __construct(Foo $foo) { }
}
```
Here, `Bar` uses `Foo` as a dependency. With Laravel’s IoC container, we state that we wish `Foo` to have a Singleton Object Lifecycle. This keeps instantiation of objects away from both the `Foo` and `Bar` classes, which is what we want. This gives us several benefits. First, `Foo` doesn’t need extra work just because we want it to have the Lifecycle of a Singleton. Second, we have a single place where we can change the lifecycle of `Foo`. Third, when we decide that we no longer want `Foo` to have a Singleton Object Lifecycle, we won’t have to muck around the internals of `Foo` to make that happen. `Foo` can remain just the way it is.

Using methods like this to control the lifecycle of objects allows us to use Singletons without having to resort to the Singleton anti-pattern. Be sure to look into your DI tool of choice to figure out how to make it work for your applications.

