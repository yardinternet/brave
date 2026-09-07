<?php

declare(strict_types=1);

namespace App\Blocks\Section;

class Section
{
	public function render(array $attributes, string $content = ''): string
	{
		if ('' === trim($content)) {
			return '';
		}

		$attributes = get_block_wrapper_attributes(array_merge($attributes, [
			'class' => 'alignfull',
		]));

		return sprintf('<div %s>%s</div>', $attributes, $content);
	}
}
