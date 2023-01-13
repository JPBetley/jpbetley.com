---
extends: _layouts.post
section: content
title: Vagrant Gulp Notifications
date: 2014-02-07
created_at: 2014-02-06T20:06:41.000Z
updated_at: 2014-02-07T02:38:46.000Z
published_at: 2014-02-07T02:38:46.000Z
description: Vagrant Gulp Notifications
cover_image: /assets/img/post-cover-image-2.png
---

One of my favorite packages to use with gulp is [gulp-notify](https://github.com/mikaelbr/gulp-notify) which will display notification messages whenever a task is run. It allows me to see what gulp is doing without having to navigate away from my editor. Here's an example for a sass compilation task.

```
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
```

Piping the notify function with a message will display a notification with that message when the task is run. For me, that will be displayed using Mac's Notification Center.

<a href="https://imgur.com/flNLQwN"><img src="https://i.imgur.com/flNLQwN.png" title="Hosted by imgur.com" /></a>

Now, this is all well and good, but I personally run my development environment inside of a Vagrant VM. Getting these notifications to be triggered from vagrant and be sent to Notification Center requires a little work.

###Make Vagrant Forward Notifications
On the vagrant side of things, there is a plugin available to forward notifications from guest to host. [Vagrant notify](https://github.com/fgrehm/vagrant-notify) works by starting a TCPServer to listen for messages sent to it. These messages are sent by the `notify-send` script that is placed on the guest vm on boot by the plugin. 

To install the plugin, run `$ vagrant plugin install vagrant-notify` and it will be used for all vagrant machines from now on.

Now, `gulp-notify` will call the `notify-send` script provided by the plugin which will forward messages to the TCPServer listening on the host. The TCPServer will then call **another** `notify-send` script on the host, in this case, a Mac. 

###Mac's Notify-send Script
Before getting to the script, there is a required tool to download called [terminal-notifier](https://github.com/alloy/terminal-notifier), which is a ruby application that sends messages to Notification Center. 

I recommend grabbing the [prebuilt binary](https://github.com/alloy/terminal-notifier/releases/download/1.5.0/terminal-notifier-1.5.0.zip) and dropping it in `/Applications` as I had some trouble with the gem install version.

Once it has been downloaded, we need to write a short bash script called `notify-send` to run the terminal-notifier application with the message.

```
#!/bin/zsh
/Applications/terminal-notifier.app/Contents/MacOS/terminal-notifier -title "$2" -message "$3"
```

Since the format of the message being sent by the vagrant plugin is `-- "Gulp Notification" "Message"`, we'll use the last two arguments to send to the terminal-notifier application. Now, move the script to a directory in your `$PATH`, such as `/usr/local/bin`, and make the script executable. 

With all the pieces in place, whenever one of your Gulp tasks running in your vagrant machine sends a `notify` message, it will be forwarded to your Mac's Notification Center. 


