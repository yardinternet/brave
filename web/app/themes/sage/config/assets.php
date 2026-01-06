<?php

declare(strict_types=1);

return [

	/*
	|--------------------------------------------------------------------------
	| Default Assets Manifest
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default asset manifest that should be used.
	| The "theme" manifest is recommended as the default as it cedes ultimate
	| authority of your application's assets to the theme.
	|
	*/

	'default' => 'theme',

	/*
	|--------------------------------------------------------------------------
	| Assets Manifests
	|--------------------------------------------------------------------------
	|
	| Brave handles assets a little different from native Sage themes. Build
	| assets are still placed in the `public` directory inside our theme but it
	| does not contain any manifest files.
	|
	*/

	'manifests' => [
		'theme' => [
			'path' => get_theme_file_path('public'),
			'url' => get_theme_file_uri('public'),
		],
	],
];
