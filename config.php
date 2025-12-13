<?php

return [
	'site_title' => 'A palavra de Haroldo Watson',
'production' => false,
'baseUrl' => 'http://localhost:8000/',
'description' => 'Um blog sobre computação, multimídia, opiniões perturbadoras e dominação global',
'collections' => [
	'posts' => [
		'extends'=>'_layouts.post',
		'section'=>'postContent',
		'path'=>'{date|Y/m/d}/{-title}'
	],
	'pages' => [
		'extends'=>'_layouts.page',
		'section'=>'pageContent',
		'path'=>'{permalink}'
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
