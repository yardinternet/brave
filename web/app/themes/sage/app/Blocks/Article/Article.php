<?php

declare(strict_types=1);

namespace App\Blocks\Article;

use App\Blocks\Block;

class Article extends Block
{
	protected array $classes = ['layout-article'];

	public static string $name = 'theme/article';
}
