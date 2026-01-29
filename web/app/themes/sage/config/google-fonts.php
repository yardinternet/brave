<?php

declare(strict_types=1);

return [

	/*
	 * Here you can register fonts to call from the @googlefonts Blade directive.
	 * The google-fonts:fetch command will prefetch these fonts.
	 */
	'fonts' => [
		'default' => 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300..800&display=swap',
	],

	/*
	 * This disk will be used to store local Google Fonts. The public disk
	 * is the default because it can be served over HTTP with storage:link.
	 */
	'disk' => 'google-fonts',

	/*
	 * When something goes wrong fonts are loaded directly from Google.
	 * With fallback disabled, this package will throw an exception.
	 */
	'fallback' => env('WP_ENV') === 'production',
];
