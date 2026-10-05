<?php

declare(strict_types=1);

namespace App\Blocks;

use Illuminate\Support\Arr;

final class BackButton extends Block
{
	protected function with(array $attributes, \WP_Block $block): array
	{
		return [
			'classes' => Arr::toCssClasses([
				wp_get_block_default_classname($block->name),
				'align' . ($attributes['align'] ?? '') => ! empty($attributes['align']),
				$attributes['className'] ?? '',
			]),
		];
	}

	protected function shouldRender(string $content): bool
	{
		return (bool) wp_get_post_parent_id();
	}
}
