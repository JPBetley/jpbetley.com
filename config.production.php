<?php

return [
    'baseUrl' => 'https://jpbetley.com',
    'build' => [
        'source' => 'src',
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
