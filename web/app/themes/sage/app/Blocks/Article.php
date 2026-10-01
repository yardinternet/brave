<?php

declare(strict_types=1);

namespace App\Blocks;

class Article extends Block
{
	protected array $classes = ['layout-article'];

	public static string $name = 'theme/article';
}
