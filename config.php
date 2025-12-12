<?php

return [
	'site_title' => 'A palavra de Haroldo Watson',
'featured' => '?',
'production' => false,
'baseUrl' => '',
'description' => 'Um blog sobre computação, multimídia, opiniões perturbadoras e dominação global',
'collections' => [
	'posts' => [
		'path'=>'{date|Y/m/d}/{-title}'
	],
	'pages' => [
		'path'=>'permalink'
	]
],
'nav' => [
		[
		'label' => "Home",
		'url' => '/'
		],
		[
		'label' => "Recomendados",
		'url' => '/recomendacao/'
		]
	]
];
