---
extends: _layouts.post
section: content
title: StaticShowdown 2014
date: 2015-01-29
created_at: 2015-01-25T03:45:31.006Z
updated_at: 2015-02-07T18:58:03.227Z
published_at: 2015-01-29T04:01:04.225Z
description: StaticShowdown 2014
cover_image: /assets/img/post-cover-image-2.png
---

#My Very First Hackathon
[Rob](https://twitter.com/politburoslucre), a classmate and good friend of mine, invited me to work with him and a few coworkers on their StaticShowdown team. He sent me the link, and I almost immediately replied yes. I'd never done a hackathon before, and this one looked especially fun, taking place over 48 hours this past weekend.

StaticShowdown is a virtual hackathon where the only constraint is no backend code! Anything you can throw into a web page is fair game, and you can communicate with any service you haven't developed for the purpose of the hackathon. This means tools like Firebase, Facebook, Twitter, and any other APIs are fair game.

The idea for our app is an integration with the Facebook Events API that allows users to notify event hosts what he/she will be bringing to various events. Authentication and the events themselves would be handled by Facebook, making a lot of the data interaction fairly straightforward. We would then tie in the events to a store on Firebase, which tracks the items each user is bringing to the event. Firebase also provides excellent OAuth integration for Facebook, making authentication that much easier. 

With our idea in our heads, and the tools in our hands, we began sharply at 7:00 PM. Computer humming, keyboard at the ready. And then...near full stop.

#It has begun...
Starting out was MUCH slower than I originally thought. Trying to have four people simultaneously work on something when you have a blank slate is difficult, as each will most likely go in a different direction. We knew this before we started, having decided on the technologies to use (Angular, Sass, Polymer, etc). We also decided to use Yeoman to scaffold the app. But even then, starting was slow going. Deciding who would do what when was hard. And I'm sure it was only made harder by the fact that the others were in a room in Boston, and I was in my house in Rochester, NY.

But eventually, we began making progress. We had an app structure. We had a Firebase schema. We had a homepage. We could sign in with Facebook. Piece by piece, things began to come together, and we could see an app in our sights.

By the end, we had a **mostly** functional application. It wasn't entirely finished, but we were rather proud of the progress we had made. And we had a lot of fun making it.


#Experience Earned, Lessons Learned
First and foremost, my inital reaction after finishing my first hackathon: THAT WAS AWESOME! WHEN'S THE NEXT ONE?! Of course, I had a blast. I had a great team, we had a project we thought had some great potential, and we put our best foot forward. In the end we ended up with something we were all proud of. And it was also something that could even be taken, and improved upon in the future. There's no reason this app should end with the hackathon. I also ended up learning a ton about different technologies.

######Angular
I worked Angular for the first time, which was very fun and challenging. To me, Angular was good at what it did, but left me wishing for many other features I've been used to while toying with Ember. In fact, it solidified my decision to pursue learning Ember to its fullest extent. That's not meant to be a jab at Angular, but more an acknowledgement of the capabilities I get from an Ember application.

######Polymer
Also in that list is Polymer, the library for utilizing Web Components. While I'm used to the premise being akin to Ember Components, the behavior of Polymer elements was wildly fascinating. Polymer confused me greatly at first, but after a bit, I found immense power in those little elements. I did have a few issues/oddities with it however. I couldn't get it to play nicely with Angular's databinding, which is more a nice-to-have and not a deal breaker. I also couldn't figure out a good way to integrate it with our Gulp build pipeline. This meant any new Polymer elements would have to be included as a `link` reference, which was already a bit strange to me to begin with. 

#Final Thoughts
Anyone who is even remotely interested in software development or design should consider going to at least one hackathon. It is an awesome and fun time, and I can almost certainly guarantee you will enjoy it. Be open about trying new things, learning new tools, and adopting new ideas. And be sure to build something GREAT.
