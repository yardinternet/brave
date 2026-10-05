<?php

declare(strict_types=1);

namespace App\Blocks;

class Block
{
	public function __invoke(array $attributes, string $content, \WP_Block $block): string
	{
		if (! $this->shouldRender($content)) {
			return '';
		}

		return view('blocks.' . str_replace('/', '.', $block->name), [
			'attributes' => $attributes,
			'blockClassName' => wp_get_block_default_classname($block->name),
			'content' => $content,
			...$this->with($attributes, $block),
		])->render();
	}

	protected function with(array $attributes, \WP_Block $block): array
	{
		return [];
	}

	protected function shouldRender(string $content): bool
	{
		return '' !== trim($content);
	}
}
