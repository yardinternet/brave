<?php

declare(strict_types=1);

use App\Blocks\BackButton\BackButton;

return [
	/**
	 * Register a block type with the same parameters as the `register_block_type` function.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	'back-button' => [
		'block_type' => 'back-button',
		'args' => [
			'render_callback' => (new BackButton())->render(...),
		],
	],
];
