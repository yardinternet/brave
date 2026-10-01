<?php

declare(strict_types=1);

use App\Blocks\Article;
use App\Blocks\BackButton;
use App\Blocks\Banner;
use App\Blocks\Card;
use App\Blocks\Group;
use App\Blocks\Section;

return [
	/**
	 * Register a block type with the same parameters as the `register_block_type` function.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	'article' => [
		'block_type' => 'article',
		'args' => [
			'render_callback' => (new Article())->render(...),
		],
	],
	'back-button' => [
		'block_type' => 'back-button',
		'args' => [
			'render_callback' => (new BackButton())->render(...),
		],
	],
	'banner' => [
		'block_type' => 'banner',
		'args' => [
			'render_callback' => (new Banner())->render(...),
		],
	],
	'group' => [
		'block_type' => 'group',
		'args' => [
			'render_callback' => (new Group())->render(...),
		],
	],
	'card' => [
		'block_type' => 'card',
		'args' => [
			'render_callback' => (new Card())->render(...),
		],
	],
	'section' => [
		'block_type' => 'section',
		'args' => [
			'render_callback' => (new Section())->render(...),
		],
	],
];
