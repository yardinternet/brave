<?php

declare(strict_types=1);

namespace App\View\Components;

use Log1x\Crumb\Facades\Crumb;
use Roots\Acorn\View\Component;

class Breadcrumb extends Component
{
	public function __construct()
	{
	}

	private function items(): \Illuminate\Support\Collection
	{
		return Crumb::build();
	}

	public function render(): \Illuminate\View\View|string
	{
		return $this->view('components.breadcrumb', [
			'items' => $this->items(),
		]);
	}
}
