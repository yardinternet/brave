<?php

declare(strict_types=1);

return [
	/**
	 * Allowed custom blocks provided by the Yard Gutenberg plugin.
	 */
	'allowedBlocks' => [
		'collapse',
		'collapse-item',
		'counting-number',
		'facetwp',
		'icon',
		'iconlist',
		'iconlist-item',
		'slide',
		'slider',
		'tabs',
		'tabs-item',
		'timeline',
		'timeline-item',
	],

	/**
	 * Allowed core blocks (whitelist).
	 *
	 * @see https://github.com/yardinternet/plugin-yard-gutenberg/blob/main/src/Hooks/DefaultHookManager.php#L21
	 */
	'allowedCoreBlocks' => [
		// 'core/search',
	],
	'excludedCoreBlocks' => [
		// 'core/post-featured-image',
	],

	/**
	 * Reusable block groups used by both post type restrictions and inner block restrictions.
	 */
	'blockSets' => [
		'content' => [
			'core/audio',
			'core/block',
			'core/button',
			'core/buttons',
			'core/embed',
			'core/file',
			'core/gallery',
			'core/group',
			'core/heading',
			'core/html',
			'core/image',
			'core/list-item',
			'core/list',
			'core/missing',
			'core/paragraph',
			'core/pattern',
			'core/post-featured-image',
			'core/quote',
			'core/separator',
			'core/spacer',
			'core/table',
			'core/video',
			'gravityforms/form',
			'yard/collapse-item',
			'yard/collapse',
			'yard/iconlist-item',
			'yard/iconlist',
			'yard/timeline-item',
			'yard/timeline',
		],
		'minimalContent' => [
			'core/button',
			'core/buttons',
			'core/heading',
			'core/list-item',
			'core/list',
			'core/paragraph',
			'yard/icon',
			'yard/iconlist-item',
			'yard/iconlist',
		],
	],

	/**
	 * Restrict available blocks per post type.
	 *
	 * `blockSet` references one of the sets in `blockSets`
	 * `add` appends blocks
	 * `remove` removes blocks from the final list
	 */
	'postTypeBlockRestrictions' => [
		'news' => [
			'blockSet' => 'content',
			'add' => [
				//
			],
			'remove' => [
				//
			],
		],
	],

	/**
	 * Restrict available inner blocks per parent block
	 */
	'innerBlockRestrictions' => [
		'core/media-text' => [
			'blockSet' => 'minimalContent',
		],
		'yard/collapse-item' => [
			'blockSet' => 'content',
			'remove' => [
				'yard/collapse',
				'yard/collapse-item',
			],
		],
		'yard/tabs-item' => [
			'blockSet' => 'content',
		],
	],

];
