<?php

declare(strict_types=1);

namespace App\Csp;

use Yard\Csp\Policies\Basic;

class Policy extends Basic
{
	public function configure()
	{
		parent::configure();

		// Add site specific csp directives below
	}
}
