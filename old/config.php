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
		'path'=>'{date|Y/m/d}/{-title}',
    'sort'=>['-date'],
    'filter' => function($item){
      return !$item->draft;
    }
	],
	'pages' => [
		'extends'=>'_layouts.default',
		'section'=>'content',
		'path'=>'pages/{-title}'
	]

	],
'nav' => [
		[
		'label' => "Home",
		'url' => '/'
		],
		[
		'label' => "Postagens",
		'url' => '/posts/'
		],
    [
		'label' => "Recomendados",
		'url' => '/pages/recomendacoes/'
		]
	]
];
