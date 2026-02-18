<?php

declare(strict_types=1);

namespace App\View\Composers;

use Log1x\Navi\Navi;
use Roots\Acorn\View\Composer;

class NaviComposer extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'components.header.*',
		'sections.footer',
	];

	/**
	 * Data to be passed to view before rendering, but after merging.
	 */
	public function override(): array
	{
		return [
			'footerNavigation' => $this->footerNavigation(),
			'primaryNavigation' => $this->primaryNavigation(),
			'topBarNavigation' => $this->topBarNavigation(),
		];
	}

	public function footerNavigation(): Navi
	{
		return Navi::make()->build('footer_navigation');
	}

	public function primaryNavigation(): Navi
	{
		return Navi::make()->build('primary_navigation');
	}

	public function topBarNavigation(): Navi
	{
		return Navi::make()->build('top_bar_navigation');
	}
}
