<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Support\Collection;
use Log1x\Crumb\Facades\Crumb;
use Roots\Acorn\View\Component;
use Yard\Brave\Hooks\Traits\ParentPage;

class Breadcrumb extends Component
{
	use ParentPage;

	public function __construct(
		public string $listClass = '',
		public string $itemClass = '',
		public string $linkClass = '',
		public string $currentItemClass = '',
	) {
	}

	public function render(): \Illuminate\View\View|string
	{
		return $this->view('components.breadcrumb', [
			'items' => $this->items(),
		]);
	}

	private function items(): Collection
	{
		$items = Crumb::build();

		if (! is_singular() || is_search() || ! $this->hasParentPage(get_the_ID())) {
			return $items;
		}

		$parentItems = $this->getParentItems(get_the_ID());

		if ($parentItems->isNotEmpty()) {
			$items->splice(1, 0, $parentItems->all());
			$items = $this->removeArchive($items, get_post_type());
		}

		return $items;
	}

	private function getParentItems(int $postId): Collection
	{
		$parentIds = $this->getParentPagesIds($postId);

		return collect(array_reverse($parentIds))
			->map(fn (int $id) => [
				'id' => $id,
				'label' => get_the_title($id),
				'url' => get_permalink($id),
			]);
	}

	/**
	 * Remove the CPT archive that Log1x/Crumb adds.
	 */
	private function removeArchive(Collection $items, string $cpt): Collection
	{
		$archiveUrl = get_post_type_archive_link($cpt);

		return $items
			->reject(fn ($item) => isset($item['url']) && $item['url'] === $archiveUrl)
			->values();
	}
}
