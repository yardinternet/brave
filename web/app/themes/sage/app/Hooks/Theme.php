<?php

declare(strict_types=1);

namespace App\Hooks;

use Illuminate\Support\Facades\View;
use Yard\Hook\Action;
use Yard\Hook\Filter;

class Theme extends \Yard\Brave\Hooks\Theme
{
	#[Action('body_class')]
	public function bodyClass(array $classes): array
	{
		$classes = parent::bodyClass($classes);

		// Add extra body classes here

		return $classes;
	}

	#[Filter('admin_body_class')]
	public function adminBodyClass(string $classes): string
	{
		$classes = parent::adminBodyClass($classes);

		// Add extra admin body classes here

		return $classes;
	}

	#[Filter('the_password_form')]
	public function changePasswordForm(string $template): string
	{
		if (! View::exists('partials.password-form')) {
			return $template;
		}

		return View::make('partials.password-form')->render();
	}

	#[Filter('wp')]
	public function removeWpautopForPasswordForm()
	{
		if (is_singular() && post_password_required()) {
			remove_filter('the_content', 'wpautop');
		}
	}

	#[Filter('excerpt_allowed_wrapper_blocks')]
	public function addInnerBlocksToExcerpt(array $blocks): array
	{
		$blocksToAdd = [
			'core/media-text',
		];

		return array_merge($blocks, $blocksToAdd);
	}
}
