<?php

declare(strict_types=1);

namespace App\Blocks\BackButton;

use Illuminate\Support\Facades\Blade;
use Yard\Brave\Components\BackButton as BackButtonComponent;

class BackButton
{
	public function render(array $attributes): string
	{
		if ($this->postDoesNotHaveParent()) {
			return '';
		}

		$backButton = new BackButtonComponent();

		if (isset($attributes['align'])) {
			$backButton->align = 'align' . $attributes['align'];
		}

		if (isset($attributes['className'])) {
			$backButton->className = $attributes['className'];
		}

		return Blade::renderComponent($backButton);
	}

	private function postDoesNotHaveParent(): bool
	{
		global $post;

		if (! is_a($post, 'WP_Post')) {
			return true;
		}

		return 0 === wp_get_post_parent_id($post->ID);
	}
}
