<?php

declare(strict_types=1);

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'*',
	];

	/**
	 * Data to be passed to view before rendering.
	 */
	public function with(): array
	{
		return [
			'siteName' => $this->siteName(),
			'cookieLawPluginActive' => $this->cookieLawPluginActive(),
		];
	}

	public function siteName(): string
	{
		return get_bloginfo('name', 'display');
	}

	public function cookieLawPluginActive(): bool
	{
		if (! function_exists('is_plugin_active')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active('cookie-law-info/cookie-law-info.php');
	}
}
