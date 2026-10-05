<?php

declare(strict_types=1);

use App\Blocks\BackButton;
use App\Blocks\Banner;
use App\Blocks\Block;
use App\Blocks\Card;

return [
	/**
	 * Register a block type with the same parameters as the `register_block_type` function.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	'article' => [
		'block_type' => 'article',
		'args' => [
			'render_callback' => new Block(),
		],
	],
	'back-button' => [
		'block_type' => 'back-button',
		'args' => [
			'render_callback' => new BackButton(),
		],
	],
	'banner' => [
		'block_type' => 'banner',
		'args' => [
			'render_callback' => new Banner(),
		],
	],
	'group' => [
		'block_type' => 'group',
		'args' => [
			'render_callback' => new Block(),
		],
	],
	'card' => [
		'block_type' => 'card',
		'args' => [
			'render_callback' => new Card(),
		],
	],
	'section' => [
		'block_type' => 'section',
		'args' => [
			'render_callback' => new Block(),
		],
	],
];
