---
extends: _layouts.post
section: content
title: "HHVM and PHP: Int Max Behavior"
date: 2014-01-08
created_at: 2014-01-08T21:11:52.000Z
updated_at: 2014-01-08T23:29:21.000Z
published_at: 2014-01-08T21:32:31.000Z
description: "HHVM and PHP: Int Max Behavior"
cover_image: /assets/img/post-cover-image-2.png
---

Today, [Anthony Ferrara](https://posts/.ircmaxell.com/) mentioned some strange behaviors about the differences between HHVM and PHP runtimes. If you haven't heard of [HHVM](https://www.hhvm.com/posts/), definitely go check it out. It is a PHP execution engine built by Facebook that is extremely fast, which is why Facebook built and is using it.

However, as Anthony mentioned in his [twitter post](https://twitter.com/ircmaxell/status/421013609754288128), HHVM isn't necessarily a direct drop-in replacement for PHP. And one of his points is about the two engines' behaviors concerning `PHP_INT_MAX`.

###Making Max Overflow
So, Anthony wasn't highlighting the difference of `PHP_INT_MAX`, but rather what happens when you add to that. Conventional static-typed languages will have the [integer overflow](https://en.wikipedia.org/wiki/Integer_overflow), since it has to remain an integer. However, PHP is a dynamically-typed language, and so it adjusts itself to become a floating-point value so that it will accept the addition accurately.

But HHVM doesn't seem to follow the same rules. Let's prove it.

####The Experiment
We can show the values and types of `PHP_INT_MAX` and `PHP_INT_MAX + 1` in a short script where we `var_dump` each value.

```
<?php

echo 'PHP_INT_MAX: ';
echo var_dump(PHP_INT_MAX) . PHP_EOL;

echo 'PHP_INT_MAX + 1: ';
echo var_dump(PHP_INT_MAX + 1) . PHP_EOL;
```


####The Results
Below, we run the script using standard PHP version 5.5 (64-bit), and we see our expected output.

```
# PHP Output
$ php test.php
  PHP_INT_MAX: int(9223372036854775807)
  PHP_INT_MAX + 1: float(9.2233720368548E+18)
```

However, running the script with HHVM, we get a different result.

```
# HHVM Output
$ hhvm test.php
  PHP_INT_MAX: int(9223372036854775807)
  PHP_INT_MAX + 1: int(-9223372036854775808)
```

We can see that HHVM takes the static-typed approach to integers and overflows them to a negative value.

### Lessons Learned
This helps highlight one of the reasons why HHVM isn't yet (or may never be) a drop-in replacement for PHP. If you wish to use HHVM, **make sure your code is tested** to be confident that your application will work properly.

Whether or not PHP/HHVM should behave the way it does is a question to be answered by minds greater than my own. But for now, I hope this may save you some headache down the road.

## 


Again, thanks to Anthony Ferrara for giving me a lesson in PHP and computer science today.
