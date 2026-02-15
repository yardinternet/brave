<?php

declare(strict_types=1);

return [

	/*
	|--------------------------------------------------------------------------
	| Home
	|--------------------------------------------------------------------------
	|
	| This option controls the label used when displaying the homepage on the
	| breadcrumb.
	|
	*/

	'home' => __('Home', 'sage'),

	/*
	|--------------------------------------------------------------------------
	| Blog
	|--------------------------------------------------------------------------
	|
	| This option controls the label used when displaying the posts page on the
	| breadcrumb. If a posts page is not configured, this option can be
	| disregarded.
	|
	| If a posts page is configured but you would not like it shown in the
	| breadcrumb, you may explicitly set this option to `false`.
	|
	*/

	'blog' => get_the_title(
		get_option('page_for_posts')
	),

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| This option controls the label used when displaying the author archive
	| page on the breadcrumb.
	|
	| The `%s` identifier represents the authors configured display name.
	|
	*/

	'author' => __('Artikelen door %s', 'sage'),

	/*
	|--------------------------------------------------------------------------
	| Search
	|--------------------------------------------------------------------------
	|
	| This option controls the label used when displaying the search results
	| page on the breadcrumb.
	|
	| The `%s` identifier represents the current search query.
	|
	*/

	'search' => __('Zoekresultaten', 'sage'),

	/*
	|--------------------------------------------------------------------------
	| Not Found
	|--------------------------------------------------------------------------
	|
	| This option controls the label used when displaying the 404 error page
	| on the breadcrumb.
	|
	*/

	'not_found' => __('404 error', 'sage'),
];
