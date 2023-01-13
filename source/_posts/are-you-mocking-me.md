---
extends: _layouts.post
section: content
title: Are You Mocking Me?
date: 2013-12-11
created_at: 2013-12-11T00:07:50.000Z
updated_at: 2014-01-03T16:28:56.000Z
published_at: 2013-12-11T00:26:42.000Z
description: Are You Mocking Me?
cover_image: /assets/img/post-cover-image-2.png
---

Mocking libraries help developers easily test applications by providing better ways to ensure isolation. Today, I'll introduce you to a new and unique approach to mocking in PHP, AspectMock.

As PHP developers, we have had a long-standing issue of writing untested code. Some of that had to do with the language itself not really being designed to be testable. I mean, the dynamic languages of today like Ruby and Javascript allow you to stub static methods and redefine class methods at runtime. Some may argue that writing things like static methods are bad practice and make testability harder, but that is not the purpose of this article. (I'll have more on that topic later.)

With the advent of testing in PHP, many frameworks have been created to allow developers to test their code. Our arguable De-Facto standard unit testing framework is PHPUnit. Many use Codeception for BDD-style testing. And for mocking objects, the most vital link in the chain in my opinion, I prefer Mockery. Mocking objects allows us to easily keep isolation in our tests, so it is vital if we wish to write thorough tests. But those issues I brought up earlier of not being able to stub static methods, etc. are still an issue with PHP testing. Until Now.
 
Introducing [AspectMock](https://github.com/Codeception/AspectMock), a new mocking framework from the wonderful people over at Codeception. It uses the Go-AOP library to leverage Aspect-Oriented Programming to bring all of the capabilities that other dynamic languages provide to testing into the PHP world. If you want to know more about AOP and the GO framework, there is a great article over at [NetTuts](https://net.tutsplus.com/tutorials/php/aspect-oriented-programming-in-php-with-go/). It’s probably one of the most interesting things I’ve learned in the past few years, although I have more experience with Java's AspectJ than any PHP library.
 
Now, you came to see how this thing actually works, didn’t you? Good, let’s write some code.
```
<?php
use AspectMock\Test as test;

class Foo {

    static function simpleStatic() {
        return 'bees?!';
    }
} 

class SimpleTest extends \PHPUnit_Framework_Testcase {

    protected function tearDown() {
        test::clean(); // removes all registered test doubles
    }

    public function testStaticMethod() {
        $this->assertEquals('bees?!', Foo::simpleStatic());
        $mock = test::dummy('Foo', ['simpleStatic' => 'bar']);
        $this->assertEquals('bar', Foo::simpleStatic());
        $mock->verifyInvoked('simpleStatic');
    }			
}
```

As you can see, it's a simple test for a static method call. This may seem trivial, but it is immensly powerful in testing some of today's frameworks. For example, imagine the level of testing that is now available for Laravel's Eloquent Models, which have proven difficult to mock. The possibilities are endless.

At the end of the day, AspectMock is a very innovative mocking framework in the PHP world. It uses AOP to do things previously impossible for the language in the name of testing. I would definitely keep an eye on this project and use it every now and then. Word of warning however, it is still in early beta and many have reported problems (including myself), so don't use it in anything more than a fun pet project for the time being.
