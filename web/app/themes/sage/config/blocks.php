<?php

declare(strict_types=1);

use App\Blocks\Article\Article;
use App\Blocks\BackButton\BackButton;
use App\Blocks\Card\Card;
use App\Blocks\Group\Group;
use App\Blocks\Section\Section;

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
