<?php

declare(strict_types=1);

namespace App\View\Components\Card\Enums;

enum Direction: string
{
	case COLUMN = 'column';
	case ROW = 'row';
	case FLUID = 'fluid'; // Starts as column on mobile, switches to row on larger breakpoints

	public function isColumn(): bool
	{
		return self::COLUMN === $this;
	}

	public function isRow(): bool
	{
		return self::ROW === $this;
	}

	public function isFluid(): bool
	{
		return self::FLUID === $this;
	}
}
