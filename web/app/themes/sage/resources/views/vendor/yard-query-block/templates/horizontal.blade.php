@php
	/**
	 * Template: Horizontaal
	 *
	 * @var Illuminate\Support\Collection|Yard\Data\PostData $postDataCollection
	 * @var Yard\QueryBlock\Block\BlockAttributes $attributes
	 */

	use App\View\Components\Card\Enums\Direction;
@endphp

<div @class([
	'wp-block-yard-query mb-6 mt-5 md:mb-8 md:mt-7 max-md:auto-grid md:grid md:gap-(--grid-gutter)',
	$attributes->align(),
	$attributes->className,
])>
	@forelse ($postDataCollection as $postData)
		<x-dynamic-card :card="$postData->postType()" :direction="Direction::FLUID" :postData="$postData" :displayDate="$attributes->displayDate()" :displayExcerpt="$attributes->displayExcerpt()"
			:displayImage="$attributes->displayImage()" :displayLabel="$attributes->displayLabel()" />
	@empty
		<x-alert type="warning" class="col-span-full">
			Geen resultaten gevonden.
		</x-alert>
	@endforelse
</div>
