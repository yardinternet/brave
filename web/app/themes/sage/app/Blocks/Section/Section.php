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

		return sprintf('<div %s>%s</div>', get_block_wrapper_attributes(), $content);
	}
}
