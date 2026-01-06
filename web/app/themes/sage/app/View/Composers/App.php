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
		$activePlugins = get_option('active_plugins');

		if (is_multisite()) {
			$activePlugins = array_merge($activePlugins, array_keys(get_site_option('active_sitewide_plugins')));
		}

		return in_array('cookie-law-info/cookie-law-info.php', $activePlugins);
	}
}
