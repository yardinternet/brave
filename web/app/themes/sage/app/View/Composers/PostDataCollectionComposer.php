<?php

declare(strict_types=1);

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Yard\Data\PostData;

class PostDataCollectionComposer extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'blocks.FacetWP.loops.*-loop',
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 */
	public function override(): array
	{
		return [
			'postDataCollection' => PostData::collect($GLOBALS['wp_query']->posts),
		];
	}
}
