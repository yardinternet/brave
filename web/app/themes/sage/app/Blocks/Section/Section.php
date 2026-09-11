<?php

declare(strict_types=1);

namespace App\Blocks\Section;

use App\Blocks\Block;

class Section extends Block
{
	protected array $classes = ['alignfull'];

	public static string $name = 'theme/section';
}
