---
extends: _layouts.post
section: content
title: Gulp
date: 
created_at: 2014-02-06T18:55:07.000Z
updated_at: 2014-02-06T18:55:50.000Z
published_at: 
description: Gulp
cover_image: /assets/img/post-cover-image-2.png
---

I've been working on using [Gulp](https://gulpjs.com/) as a task runner for doing things like compiling sass and coffeescript files in my projects. Gulp has turned out to be really slick with a lot of features coming from a variety of plugin packages. 

One of my favorite packages to use with gulp is [gulp-notify](https://github.com/mikaelbr/gulp-notify) which will display notification messages whenever a task is run. It allows me to see what gulp is doing without having to navigate away from my editor.

Here is an example of a simple gulpfile that does sass compilation:

```
var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var notify = require('gulp-notify');

gulp.task('sass', function() {
	return gulp.src('app/assets/sass/style.scss')
		.pipe(sass({
			style: 'compressed'
		}))
		.pipe(gulp.dest('public/assets/css'))
		.pipe(notify({
			message: 'Compiled Sass'
		}));
});

gulp.task('watch', function () {
  gulp.watch('app/assets/sass/*.scss', ['sass']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['sass']);
```

If you're familiar with gulp, you can see the gulp-notify packages allows me to pipe to notify where I define the message to display. Running `gulp sass` will show a notification with 'Compiled Sass', which for me is displayed by Mac's Notification Center.

! PUT IMAGE HERE !

Now, this is all well and good, but I personally do development inside of a Vagrant VM.


