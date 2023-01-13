---
extends: _layouts.post
section: content
title: "Laracon NYC: Day One"
date: 2014-05-16
created_at: 2014-05-16T01:43:20.000Z
updated_at: 2014-09-18T14:55:35.000Z
published_at: 2014-05-16T04:45:03.000Z
description: "Laracon NYC: Day One"
cover_image: https://pbs.twimg.com/media/Bnrcn0_IMAE0iCR.jpg:large
featured: true
---

I have the priveledge of attending this year's Laracon in New York City, and let me tell you...IT WAS AWESOME. AND IT IS ONLY DAY HALFWAY THROUGH.

I was posting like crazy and went into a retweet frenzy pretty damn quickly, so naturally my phone dies around lunch. I saw a lot of great talks today and so, I wanted to recap today's events as a way to express what I learned, and give myself an opportunity to digest and reflect on day one  of my first ever developer conference.

<img src="https://pbs.twimg.com/media/Bnrcn0_IMAE0iCR.jpg:large" alt="Wide shot of the developer conference" />

###[Jeffrey Way](https://twitter.com/jeffrey_way)
Starting off the conference was probably the most influential developer in my personal career, Jeffrey Way. If you are not familiar with him, he currently runs [Laracasts](https://laracasts.com), which is a fantastic resource for Laravel and other web dev tools. But back in the day, he used to run Tuts+, which is where I first learned all about Codeigniter from him while building the [WITR](https://witr.rit.edu) site during my college years. That project, and his lessons, are what ultimately lead me to choosing a career in web dev. But enough about that...

Jeffrey's presentation was a bit of a potpourri. He covered a wide range of topics such as the new Mail drivers in Laravel 4.2, tools like Behat and Gulp, and a myriad of other things. It was great seeing him kick things off with all of these tips, tricks, and tools, which is really what Jeffrey does best: whetting our appetites and letting us dig deeper ourselves.

###[Jeremy Lindblom](https://twitter.com/jeremeamia)
Next up was Jeremy Lindblom from Amazon talking about integrating AWS with Laravel. He showed off a lot of the cool services AWS provides that can be utilized for and by our Laravel applications. 

During his talk, he arhictected a scalable application using many of Amazon's platforms, using Laravel and the AWS SDK, which Jeremy works on. It was quite impressive to see the pieces fit together. I do wish his "funny faces" app he walked through was public so everyone at the conference could upload their own selfies using it.

###[Jeremy Mikola](https://twitter.com/jmikola)
Following Jeremy is Jeremy (Mikola) with his talk about [React PHP](https://reactphp.org/). React allows for asynchronous handling of events to be processed by your PHP application. Anyone who has used node.js before will understand immediately how this works. Jeremy showcased the benefits that asynchronous programming offers, presenting it in a understandable manner using Mario gifs! He even had a running chat app using React open during his talk that people could hop on (a bold, risky move with it showing on the big screen at a conference, but it went swimmingly).

###[Shawn McCool](https://twitter.com/ShawnMcCool)
After lunch, Shawn McCool gave a talk about integrating patterns derived from Design Driven Development practices during his revamp of the [Laravel.IO](https://laravel.io/forum) codebase. This was probably my **favorite** talk of the day. 

<img src="https://pbs.twimg.com/media/BnsiTmrCIAEDiw9.jpg:large" alt="Shawn McCool presenting at Laracon" />

A major focus of his talk was on using a `CommandBus` to dispatch different `Commands` to `CommandHandlers` that directly derive themselves from business rules and actions. For example, you could have a `RegisterUserCommand` which does exactly what it sounds like, registers a user, fulfilled by the `RegisterUserHandler`. He also talked about using events and event dispatchers to keep code clean and each module focussed on a single responsibility. 

This talk hit upon a lot of things that I have been learning about recently with my light exploration in DDD, and seeing Shawn's presentation really made a lot of things much clearer for me. This was a presentation that I learned a lot from and could take back to work with me and directly put these practices to use.

###[Tim Griesser](https://twitter.com/tgriesser)
Tim's presentation was focussed less on Laravel and PHP, and more on web development on the other side of the fence/browser: Javascript. Tim touched on the tools, tips, tricks, and frameworks that are within the great expanse of this language. 

Javascript has many competing ecosystems and tools battling for attention, which differs from languages like PHP, Python, and Ruby. There are multiple popular build tools, package managers, and **my god** the number of frameworks/libraries. This is by no means a bad thing, and just happens to be a nature of the complexity that developers utilize Javascript in their applications. Tim's presentation was a welcome reminder that our jobs are to provide easy to use functionality for users, and Javascript remains a large part of that. (AND I FOR ONE WELCOME OUR NEW NODE.JS OVERLORDS)

###Lightning Talks
Sara Goleman from Facebook was meant to give a talk in this slot, but was unable to attend. To fill the time, there were three lightning talks, (and some break dancing by [Maks Surguy](https://twitter.com/msurguy) which was impressive).

####[Ian Landsman](https://twitter.com/ianlandsman)
Ian, the founder of UserScape, talks about giving back to Open Source in your company. He discussed his business's practice in allowing Taylor to work on the Laravel framework on UserScape's time, and why he thinks devoting just one work day a month from a developer can feed back many times over for the betterment of the company.

I thoroughly enjoyed this talk, and even had the pleasure of talking to Ian himself afterwards about how he thinks other businesses can get involved. As an open source supporter, I got some tips from him on how best to approach helping open source projects through the business, and how to create a more open culture within the workspace, and the community at large.

####[Kayla Daniels](https://twitter.com/kayladnls)
Kayla had probably the most powerful talk of the day. A very important, and very debated topic, within the tech community today, is the issue of marginalism, most commonly observed as sexism against women. 

Kayla presented what she called the **"Code Manifesto"**. It is a simple set of guidelines that, if followed, would allow us to not only become better developers, but better people. And I think it is a fantastic idea. 

<img src="https://pbs.twimg.com/media/Bntd9tGIMAAwHZn.jpg" alt="Kayla Daniels presenting at Laracon" />

####[Jeremy Mikola](https://twitter.com/jmikola)
Jeremy came back for a lightning talk about...lightning. No seriously. It was a 4-minute, rapid-fire, funny, entertaining talk that had the whole conference guffawing and knee-slapping.

###[Taylor Otwell](https://twitter.com/taylorotwell)

Then came Taylor Otwell with his keynote address, the one everyone has been waiting for. He started off covering where Laravel has been in the past year, and where it is going in the year to come.

<img src="https://pbs.twimg.com/media/BntJUnhCcAAM1Ql.jpg:large" alt="Taylor Otwell presenting at Laracon" />

Then, he started dropping bombs. He started with [Laravel Homestead](https://laravel.com/docs/homestead), a preconfigured vagrant box, made with practically all the tools and software you can think of too use all of the features in Laravel. Not just a standard LEMP stack, it includes memcached, beanstalk, supervisor, redis, etc. for your use. And their is no need to provision it anymore, the box is already set up. So instead of a 10 minute coffee break while vagrant boots, it's a 10 second download. **Fantastic.**

But he wasn't done yet. 

Then he unveiled his big project: [Laravel Forge](https://forge.laravel.com/). This is a web application to manage, provision, and maintain your cloud servers for your Laravel apps. It hooks into the APIs for Linode, DigitalOcean, and EC2 to do all of the work for you, provisioning the same stack as Homestead. The features go on and on, and you should do yourself a favor and check it out.

I am reminded of DDH's keynote from a few weeks ago, when he declared "TDD is Dead". Yes, it spawned a lot of conversation because it was inflammatory, but to me, it seems like a cheap way to make it seem as though his presentation had substance. Taylor's presentation, in comparison, showed what developers really care about: tools they can use! It shows Taylor's commitment to Laravel and the community as a whole.

Taylor has done a great job in providing developers the tools to create a unified Laravel experience, from **download to deploy**. Laravel's future looked bright, and now it certainly look brighter.

---

Go ahead and read my experiences of [Day Two of Laracon](https://jpbetley.com/laracon-nyc-day-two/)
