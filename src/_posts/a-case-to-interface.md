---
extends: _layouts.post
section: content
title: A Case For An Interface
date: 
created_at: 2014-09-16T15:55:42.000Z
updated_at: 2014-09-18T19:22:09.000Z
published_at: 
description: A Case For An Interface
cover_image: /assets/img/post-cover-image-2.png
---

I had an interesting discussion the other day with a colleague about some code I had written. He didn't understand why I had written an interface for a class when there didn't seem to be any kind of inheritance or multiple implementations. Essentially, he asked the questions "Why can't I just use the class instead of the interface?".

When he asked this, I tried to come up with a good explanation, and my words failed me. This was just the way I've been doing it for so long, I couldn't adequately express why I had intuitively created an interface when I didn't have multiple implementations. I've since solidified my ideas, but before going into them, I'd like to explicitly describe the case against.

##The Case Against
The side my colleague was taking was all about the utility of the code within the application. Say we have `ClassA` which implements `InterfaceA` and `ClassB` which depends upon `InterfaceA`. In this example, `ClassB` could just depend directly upon `ClassA` and no functionality would change. The case against argues about adding additional complexity and indirection by introducing the Interface which adds nothing to the functionality of the code that needs to be executed.

Now, let's imagine a `ClassC`, which also implemented `InterfaceA`. We no longer want to use `ClassA` at all, and want to use `ClassC`. This case argues that we can either change `ClassB` to use `ClassC` which isn't that much work to change. Or since we no longer are using `ClassA`, why not just replace the functionality of `ClassA` to be what `ClassC` is, and `ClassB` no longer has to change. Essentially, if we want `ClassA` to function like `ClassC` now, why not just change `ClassA` instead of introducing a second class.

The crux of this argument is based upon the idea that an interface is only useful for determining the root structure of inheritance. In this case, if I want to use both `ClassA` and `ClassC` in `ClassB` there needs to be some commonality between them, so an interface is introduced. But if only one class is used during run time, there is no need for an interface, as the implementation can be used directly as the dependency.

##The Case For

Design. To me one of the biggest benefits of using interfaces is the ability to direct the design and architecture of my application.

Object-oriented programming is commonly defined as designing code around "objects" that contain data and have methods that manipulate that data. Many, including myself, have come to redefine it as

Interfaces shouldn't be used as a way to identify that there are multiple implementations or even BECAUSE there are multiple implementations. Interfaces should really be thought of as Contracts. And not just contracts used by classes that depend upon them, but by their implementations as well.

Too many times have I seen (and written) code, where the functionality of a dependency changes and breaks the class depending upon it. I may have changed a query and it now returns a different or altered set of data. This is due to the implementation breaking a contract in the code. Interfaces are meant to define and document expected behavior on both the implementation and
depending class.

Now, not every class needs to have an Interface to define it. Interfaces are really only useful for boundaries of our application. For example, say we need to have state of our application to be persisted. We can implement an interface (contract) that our application can use with the knowledge that no matter the implementation, the expected result is that the data is persisted. We don't need to know how it's done, just that it gets done.

By using Interfaces as Contracts, we also get the benefit of testable code. We no longer need to be aware of the underlying behavior of a class's dependencies. We just need to make assumptions and verifications in our tests about those dependencies. This is what mocking/stubbing is used for.

