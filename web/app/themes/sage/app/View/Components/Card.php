<?php

declare(strict_types=1);

namespace App\View\Components;

use \Yard\Data\Contracts\PostDataInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
	public function __construct(
		public ?PostDataInterface $postData = null,
		public ?bool $displayDate = null,
		public ?bool $displayExcerpt = null,
		public ?bool $displayImage = null,
		public ?bool $displayLabel = null,
		public ?bool $thumbnailIsLogo = null,
		public ?string $dateString = null,
		public ?string $dateTime = null,
		public ?string $excerpt = null,
		public ?string $label = null,
		public ?string $url = null,
		public ?string $postType = null,
		public ?string $subtitle = null,
		public ?string $thumbnailUrl = null,
		public ?string $title = null,
		public int $postID = 0,
		public string $titleTag = 'h3',
	) {
		$this->hydrate();
		$this->hydratePostTypeDefaults();
		$this->setDisplayDefaults();
	}

	protected function hydrate(): void
	{
		// This method is intended to be overridden in subclasses
	}

	private function hydratePostTypeDefaults(): void
	{
		if (null === $this->postData) {
			return;
		}

		$this->dateString ??= $this->postData->date('j F Y');
		$this->dateTime ??= $this->postData->date('Y-m-d');
		$this->excerpt ??= $this->postData->excerpt();
		$this->url ??= $this->postData->url();
		$this->postID = $this->postData->id();
		$this->thumbnailUrl ??= $this->postData->thumbnail()?->url();
		$this->title ??= $this->postData->title();
		$this->postType ??= $this->postData->postType();
	}

	private function setDisplayDefaults(): void
	{
		$this->displayDate ??= false;
		$this->displayExcerpt ??= true;
		$this->displayImage ??= true;
		$this->displayLabel ??= true;
		$this->thumbnailIsLogo ??= ! $this->thumbnailUrl;
	}

	public function cardClass(): string
	{
		return 'card' . ($this->postType ? " card-{$this->postType}" : '');
	}

	public function render(): View
	{
		return view('components.card');
	}
}
