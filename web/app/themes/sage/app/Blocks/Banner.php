<?php

declare(strict_types=1);

namespace App\Blocks;

final class Banner extends Block
{
	/**
	 * @param array<string, mixed> $attributes
	 *
	 * @return array<string, mixed>
	 */
	protected function with(array $attributes, \WP_Block $block): array
	{
		return [
			'image' => $this->renderImage($attributes, $block, 'full'),
		];
	}
}
