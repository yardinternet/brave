<?php

declare(strict_types=1);

namespace App\Blocks\Card;

class Card
{
	public function render(array $attributes, string $content = '')
	{
		$view = 'blocks.theme.card';

		if (! view()->exists($view) || '' === trim($content)) {
			return '';
		}

		return view($view, [
			'attributes' => $attributes,
			'blockWrapperAttributes' => get_block_wrapper_attributes(),
			'content' => $content,
		]);
	}
}
