<?php

declare(strict_types=1);

namespace App\Blocks;

use Illuminate\Contracts\View\View;

abstract class Block
{
	public static string $name;

	public function render(array $attributes, string $content, \WP_Block $block): View|string
	{
		$view = static::getViewPath();

		if (! view()->exists($view) || $this->isEmpty($content)) {
			return '';
		}

		return view($view, [
			'attributes' => $attributes,
			'blockDefaultClassname' => static::getBlockDefaultClassname(),
			'blockWrapperAttributes' => get_block_wrapper_attributes(),
			'content' => $content,
		]);
	}

	protected function isEmpty(string $content): bool
	{
		return '' === trim($content);
	}

	protected static function getViewPath(): string
	{
		return 'blocks.' . str_replace('/', '.', static::$name);
	}

	protected static function getBlockDefaultClassname(): string
	{
		return wp_get_block_default_classname(static::$name);
	}
}
