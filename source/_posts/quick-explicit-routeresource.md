---
extends: _layouts.post
section: content
title: "Quick, Explicit Route::resource"
date: 2014-01-26
created_at: 2014-01-26T02:33:53.000Z
updated_at: 2014-01-26T02:51:16.000Z
published_at: 2014-01-26T02:43:27.000Z
description: "Quick, Explicit Route::resource"
cover_image: /assets/img/post-cover-image-2.png
---

Laravel provides some excellent helpers for setting up routes in your web application. And when building RESTful and resourceful applications in Laravel, there is a helper, `Route::resource` that makes it easy to create a whole set of routes to a controller that manages that resource.

However, many developers, myself included, think it is a better practice to explicity name all of the routes that would be covered by the `Route::resource` helper. But typing all of those routes is time consuming, so I created a simple Sublime Text snippet to help out with that.

```
<snippet>
	<content><![CDATA[
Route::get('${1:resource}', ['as' => '${1}.index', 'uses' => '${1/(.+)/\u\1/g}sController@index']);
Route::get('${1}/create', ['as' => '${1}.create', 'uses' => '${1/(.+)/\u\1/g}sController@create']);
Route::post('${1}', ['as' => '${1}.store', 'uses' => '${1/(.+)/\u\1/g}sController@store']);
Route::get('${1}/{${1}}', ['as' => '${1}.show', 'uses' => '${1/(.+)/\u\1/g}sController@show']);
Route::get('${1}/{${1}}/edit', ['as' => '${1}.edit', 'uses' => '${1/(.+)/\u\1/g}sController@edit']);
Route::put('${1}/{${1}}', ['as' => '${1}.update', 'uses' => '${1/(.+)/\u\1/g}sController@update']);
Route::patch('${1}/{${1}}', ['uses' => '${1/(.+)/\u\1/g}sController@update']);
Route::delete('${1}/{${1}}', ['as' => '${1}.destroy', 'uses' => '${1/(.+)/\u\1/g}sController@destroy']);
]]></content>
 
	<tabTrigger>r::r</tabTrigger>
	
	<scope>source.php</scope>
</snippet>
```

The [snippet](https://gist.github.com/JPBetley/8627121) itself is triggered by `r::r` in php files and provides a quick way to create all your required routes for your resource, mapping to a controller of the same name.

To use the snippet, just download the [gist](https://gist.github.com/JPBetley/8627121) and include it in the `Packages\User` directory of your Sublime Text installation.

The video below shows the use of the snippet in Sublime Text.

<iframe name='quickcast' src='https://quick.as/embed/lr5h08q' scrolling='no' frameborder='0' width='100%' allowfullscreen></iframe><script src='https://quick.as/embed/script/1.52'></script>
