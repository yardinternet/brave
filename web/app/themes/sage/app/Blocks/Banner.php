<?php

declare(strict_types=1);

namespace App\Blocks;

final class Banner extends Block
{
	protected function with(array $attributes, \WP_Block $block): array
	{
		$focalPoint = $attributes['focalPoint'] ?? [];

		return [
			'imageId' => (int) ($attributes['imageId'] ?? 0),
			'focalPointStyle' => sprintf(
				'object-position: %d%% %d%%;',
				($focalPoint['x'] ?? 0.5) * 100,
				($focalPoint['y'] ?? 0.5) * 100,
			),
		];
	}
}
