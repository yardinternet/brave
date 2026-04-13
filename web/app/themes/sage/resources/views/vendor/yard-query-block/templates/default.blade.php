@php
	/**
	 * Template: Standaard
	 *
	 * @var Illuminate\Support\Collection|Yard\Data\PostData $postDataCollection
	 * @var Yard\QueryBlock\Block\BlockAttributes $attributes
	 */
@endphp

<div @class([
	'wp-block-yard-query auto-grid mb-6 mt-5 md:mb-8 md:mt-7',
	$attributes->align(),
	$attributes->className,
])>
	@forelse ($postDataCollection as $postData)
		<x-dynamic-card :card="$postData->postType()" :postData="$postData" :displayDate="$attributes->displayDate()" :displayExcerpt="$attributes->displayExcerpt()" :displayImage="$attributes->displayImage()"
			:displayLabel="$attributes->displayLabel()" />
	@empty
		<x-alert type="warning" class="col-span-full">
			Geen resultaten gevonden.
		</x-alert>
	@endforelse
</div>
