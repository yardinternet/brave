<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		parent::register();
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		parent::boot();

		foreach (config('view.componentNamespaces', []) as $prefix => $namespace) {
			Blade::componentNamespace($namespace, $prefix);
		}
	}
}
