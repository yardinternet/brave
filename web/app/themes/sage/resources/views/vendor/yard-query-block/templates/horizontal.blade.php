@php
	/**
	 * Template: Horizontaal
	 *
	 * @var Illuminate\Support\Collection|Yard\Data\PostData $postDataCollection
	 * @var Yard\QueryBlock\Block\BlockAttributes $attributes
	 */

	use App\View\Components\Card\Enums\Direction;
@endphp

<div
	class="wp-block-yard-query {{ $attributes->align() }} {{ $attributes->className }} @container mb-6 mt-5 md:mb-8 md:mt-7">
	<div class="@xl:gap-6 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-1">
		@forelse ($postDataCollection as $postData)
			<x-dynamic-card :card="$postData->postType()" :direction="Direction::FLUID" :postData="$postData" :displayDate="$attributes->displayDate()" :displayExcerpt="$attributes->displayExcerpt()"
				:displayImage="$attributes->displayImage()" :displayLabel="$attributes->displayLabel()" />
		@empty
			<x-alert type="warning" class="col-span-12">
				Geen resultaten gevonden.
			</x-alert>
		@endforelse
	</div>
</div>
