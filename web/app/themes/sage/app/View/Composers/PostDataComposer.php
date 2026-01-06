<?php

declare(strict_types=1);

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Yard\Data\PostData;

class PostDataComposer extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.content-single',
		'partials.content-single-*',
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 */
	public function override(): array
	{
		$postData = PostData::from($GLOBALS['post']);

		return [
			'postData' => $postData,
		];
	}
}
