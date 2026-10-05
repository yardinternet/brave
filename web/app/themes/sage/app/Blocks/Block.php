<?php

declare(strict_types=1);

namespace App\Blocks;

use Illuminate\Support\Str;

class Block
{
	/**
	 * @param array<string, mixed> $attributes
	 */
	public function __invoke(array $attributes, string $content, \WP_Block $block): string
	{
		if (! $this->shouldRender($content)) {
			return '';
		}

		$name = Str::after($block->name, '/');

		return view('blocks.' . $name, [
			'attributes' => $attributes,
			'blockClassName' => wp_get_block_default_classname($block->name),
			'content' => $content,
			...$this->with($attributes, $block),
		])->render();
	}

	/**
	 * @param array<string, mixed> $attributes
	 *
	 * @return array<string, mixed>
	 */
	protected function with(array $attributes, \WP_Block $block): array
	{
		return [];
	}

	protected function shouldRender(string $content): bool
	{
		return '' !== trim($content);
	}

	/**
	 * Rendered <img> for the block's imageId and focalPoint attributes, empty string without image.
	 *
	 * @param array<string, mixed> $attributes
	 */
	protected function renderImage(array $attributes, \WP_Block $block, string $size): string
	{
		$focalPoint = $attributes['focalPoint'] ?? [];

		return wp_get_attachment_image((int) ($attributes['imageId'] ?? 0), $size, false, [
			'class' => wp_get_block_default_classname($block->name) . '__image',
			'style' => sprintf(
				'object-position: %d%% %d%%;',
				($focalPoint['x'] ?? 0.5) * 100,
				($focalPoint['y'] ?? 0.5) * 100,
			),
		]);
	}
}
