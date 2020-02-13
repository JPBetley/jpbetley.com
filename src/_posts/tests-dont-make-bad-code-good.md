---
extends: _layouts.post
section: content
title: Tests Don't Make Bad Code Good
date: 2015-10-14
created_at: 2015-10-14T12:07:28.325Z
updated_at: 2015-10-14T12:28:45.479Z
published_at: 2015-10-14T12:28:45.480Z
description: Tests Don't Make Bad Code Good
cover_image: /assets/img/post-cover-image-2.png
---

Another day, another back and forth discussion on Twitter about the merits of software development. 

This morning, the topic was testing, and if having untested code inherently makes that code bad. It was all kicked off when our favorite PHP mentor [@coderabbi](https://twitter.com/coderabbi/) linked to the following from a conference:
<blockquote class="twitter-tweet" data-partner="tweetdeck"><p lang="en" dir="ltr">In <a href="https://twitter.com/hashtag/Magento2?src=hash">#Magento2</a>, untested code is incomplete code (<a href="https://twitter.com/benmarks">@benmarks</a>) <a href="https://twitter.com/hashtag/realmagento?src=hash">#realmagento</a> <a href="http://t.co/OvYX0Oczqb">pic.twitter.com/OvYX0Oczqb</a></p>&mdash; Frédéric MARTINEZ (@FredMartinez) <a href="https://twitter.com/FredMartinez/status/653961304437338116">October 13, 2015</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

####All code is tested, some way or another
To me, this discussion is very nuanced, becauase in some way, we all test our code eventually. Some people prefer to have all their code come with a suite of automated tests. This is perfectly reasonable, and something most, including myself, probably strive to do.

There are other situations where we only just manually test our code. Far too many times have I written some code or made a tweak, and booted up the browser to check if it worked or not. I doubt I'm the only one. This code is still tested, to a different degree.

Now, if you ship code which hasn't been tested in any manner, whatsoever, then I wish you good luck. Because I can almost guarantee it has something wrong with it. Doing this is extremely risky, which is the main point I'm trying to make. Testing, and the manner in which you do so, is all meant to mitigate risk.

####Risky Business
The manner in which we test our code affects the risk we take on when we ship code. Automated tests are the least risky, since they can be run quickly, and cover all areas of the codebase. Manual testing is very risky, not to mention time consuming! They tend not to be consistent, and we are unable to manually test the entire codebase when it starts to grow. And if you don't do any testing, we'll you're just inviting the worst to happen, as that code is beyond risky.

Good code is written where it provides business value and runs correctly. That's it. Good code can be written in all three of these testing scenarios. Each of them have varying levels of risk where the code written will be bad. The tests themselves aren't what dictate good vs bad code. Tests help us increase the likelihood of writing good code, but tests don't make bad code good.
