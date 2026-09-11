<?php

declare(strict_types=1);

namespace App\Blocks;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

abstract class Block
{
	public static string $name;

	protected array $classes = [];

	public function render(array $attributes, string $content, \WP_Block $block): View|string
	{
		$view = static::getViewPath();

		if (! view()->exists($view) || ! $this->shouldRender($attributes, $content, $block)) {
			return '';
		}

		return view($view, [
			'attributes' => $attributes,
			'blockDefaultClassname' => static::getBlockDefaultClassname(),
			'blockWrapperAttributes' => $this->getBlockWrapperAttributes($attributes, $block),
			'content' => $content,
		]);
	}

	protected function getClasses(array $attributes, \WP_Block $block): array
	{
		return [];
	}

	protected function getBlockWrapperAttributes(array $attributes, \WP_Block $block): string
	{
		$classes = $this->getClassList($attributes, $block);

		return get_block_wrapper_attributes('' === $classes ? [] : ['class' => $classes]);
	}

	protected function shouldRender(array $attributes, string $content, \WP_Block $block): bool
	{
		return ! $this->isEmpty($content);
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

	private function getClassList(array $attributes, \WP_Block $block): string
	{
		$classNames = Arr::toCssClasses(array_merge($this->classes, $this->getClasses($attributes, $block)));
		$classes = (array) preg_split('/\s+/', $classNames, -1, PREG_SPLIT_NO_EMPTY);

		return implode(' ', array_unique($classes));
	}
}
