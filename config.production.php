<?php

return [
    'baseUrl' => 'https://my-jigsaw-blog.com',
    'build' => [
	    'destination' => 'public',
    ],
    'production' => true,
    'collections' => [
    	'posts' => [
    		'filter' => function ($item) {
    			return $item->date;
    		}
    	]
    ]
];
