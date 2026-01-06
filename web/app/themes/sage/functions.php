<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
	wp_die(
		__('You need to install Acorn to use this theme.', 'sage'),
		'',
		[
			'link_url' => 'https://roots.io/acorn/docs/installation/',
			'link_text' => __('Acorn Docs: Installation', 'sage'),
		]
	);
}

add_action('after_setup_theme', function () {
	define('ACORN_BASEPATH', __DIR__);
	\Yard\Nutshell\bootloader()->boot();
}, 0);
