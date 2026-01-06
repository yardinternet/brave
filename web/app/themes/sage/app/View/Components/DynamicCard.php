<?php

declare(strict_types=1);

namespace App\View\Components;

use Exception;
use Illuminate\View\DynamicComponent;

class DynamicCard extends DynamicComponent
{
	public function __construct(string $card = 'card')
	{
		$prefixes = collect(config('view.componentNamespaces', []))->keys()->map(fn ($prefix) => $prefix . '::card.')->add('card.');

		foreach ($prefixes as $prefix) {
			try {
				$this->compiler()->componentClass($prefix . $card);
				$component = $prefix . $card;

				break;
			} catch (Exception $e) {
				$component = 'card';
			}
		}

		parent::__construct($component);
	}
}
