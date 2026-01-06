<?php

declare(strict_types=1);

namespace App\Hooks;

use Illuminate\Support\Facades\Vite;
use Yard\Hook\Action;
use Yard\Hook\Filter;

class Assets
{
	#[Action('wp_head', 99)]
	public function registerFrontendAssets(): void
	{
		Vite::useHotFile(get_parent_theme_file_path('public/hot'));

		echo Vite::withEntryPoints([
			'web/app/themes/' . get_stylesheet() . '/resources/styles/frontend.css',
			'web/app/themes/' . get_stylesheet() . '/resources/scripts/frontend/frontend.js',
		])->toHtml();
	}

	#[Action('admin_head')]
	public function registerBlockEditorAssets()
	{
		if (! get_current_screen()?->is_block_editor()) {
			return;
		}

		$dependencies = json_decode(Vite::content('editor.deps.json'));

		foreach ($dependencies as $dependency) {
			if (! wp_script_is($dependency)) {
				wp_enqueue_script($dependency);
			}
		}

		Vite::useHotFile(get_parent_theme_file_path('public/hot'));

		echo Vite::withEntryPoints([
			'web/app/themes/'. get_stylesheet() . '/resources/scripts/editor/editor.js',
		])->toHtml();
	}

	/**
	 * Also inject the styles into the iframe'd block editor and preview windows.
	 */
	#[Filter('block_editor_settings_all')]
	public function injectEditorStyles($settings)
	{
		$style = Vite::asset('web/app/themes/'. get_stylesheet() . '/resources/styles/editor.css');

		$settings['styles'][] = [
			'css' => "@import url('{$style}')",
		];

		return $settings;
	}

	/**
	 * This hook fires both in the editor and on the front end of your site.
	 */
	#[Action('enqueue_block_assets')]
	public function registerBlockAssets(): void
	{
		wp_enqueue_script('fontawesome', config('app.fontawesome.url'), [], null, true);
		wp_enqueue_style('theme-font-base', config('theme.font.base.url'), [], null);
	}

	/**
	 * Preconnects to Google Fonts if used by the theme.
	 */
	#[Action('wp_head', 1)]
	public function addResourceHints(): void
	{
		if (str_contains(config('theme.font.base.url'), 'fonts.googleapis.com')) {
			echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
		}
	}

	/**
	 * @see https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
	 */
	#[Action('should_load_separate_core_block_assets')]
	public function loadSeparateCoreBlockAssets(): bool
	{
		return true;
	}
}
