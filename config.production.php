<?php

return [
    'baseUrl' => 'https://jpbetley.com',
    'production' => true,
    'collections' => [
    	'posts' => [
    		'filter' => function ($item) {
    			return $item->date;
    		}
    	]
    ]
];
