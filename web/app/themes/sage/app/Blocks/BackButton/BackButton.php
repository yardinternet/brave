<?php

declare(strict_types=1);

namespace App\Blocks\BackButton;

use App\Blocks\Block;

class BackButton extends Block
{
	public static string $name = 'theme/back-button';

	protected function shouldRender(array $attributes, string $content, \WP_Block $block): bool
	{
		return $this->postHasParent();
	}

	private function postHasParent(): bool
	{
		global $post;

		if (! is_a($post, 'WP_Post')) {
			return false;
		}

		return 0 !== wp_get_post_parent_id($post->ID);
	}
}
