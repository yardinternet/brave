<?php

declare(strict_types=1);

namespace App\Blocks\Card;

use Illuminate\Contracts\View\View;

class Card
{
	public static string $name = 'theme/card';

	public function render(array $attributes, string $content, \WP_Block $block): View|string
	{
		$view = 'blocks.theme.card';

		if (! view()->exists($view) || '' === trim($content)) {
			return '';
		}

		return view($view, [
			'attributes' => $attributes,
			'blockDefaultClassname' => self::getBlockDefaultClassname(),
			'blockWrapperAttributes' => get_block_wrapper_attributes(),
			'content' => $content,
		]);
	}

	private static function getBlockDefaultClassname(): string
	{
		return wp_get_block_default_classname(static::$name);
	}
}
