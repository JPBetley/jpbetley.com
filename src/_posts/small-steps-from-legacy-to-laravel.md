---
extends: _layouts.post
section: content
title: Small Steps from Legacy to Laravel
date: 
created_at: 2016-04-20T17:04:20.421Z
updated_at: 2016-04-20T18:03:10.141Z
published_at: 
description: Small Steps from Legacy to Laravel
cover_image: /assets/img/post-cover-image-2.png
---

Legacy apps. Nasty spaghetti code that you can just never seem to cleanup. Every time you touch the codebase, you think to yourself "I wish I could just rewrite this thing from scratch using a framework, like Symfony or Laravel".

Rewrites are hard. Trust me, I've tried them. Sometimes I've succeeded. Sometimes I haven't. But incremental refactoring of a legacy system can seem so daunting a task, that sometimes the rewrite using a fully-featured framework seems too enticing to pass up.

What I'm going to detail is how I arrived at the best of both worlds. Step by step, I refactored my legacy system into what the app would have been like if I'd written it starting with Laravel. Module by module, I incorporated Illuminate libraries into the code until it was structured and behaved like a Laravel app.

###### Step #1: Bumping the PHP Version

I wanted this to be the first thing I did for two main reasons:

* The version of PHP running on the server has been EOL for over 2 years
* I needed to use composer, and that required a newer version of PHP

Jumping a few minor versions in PHP only had one *real* snag, and that was SQL Server extensions.

This app was running on IIS and connected to a SQL Server database (it was like that when I got here). For PHP versions older than 5.3, the `mssql` extension was used for database calls. However, all versions after that used the newer `sqlsrv` extension. 

I performed some regex-foo to find and replace all of the calls to the newer version
