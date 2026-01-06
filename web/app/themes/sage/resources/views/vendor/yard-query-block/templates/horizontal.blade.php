@php
	/**
	 * Template: Horizontaal
	 *
	 * @var Illuminate\Support\Collection|Yard\Data\PostData $postDataCollection
	 * @var Yard\QueryBlock\Block\BlockAttributes $attributes
	 */
@endphp

<div
	class="wp-block-yard-query {{ $attributes->align() }} {{ $attributes->className }} @container mb-6 mt-5 md:mb-8 md:mt-7">
	<div class="@xl:gap-6 grid grid-cols-1 gap-4">
		@forelse ($postDataCollection as $postData)
			<x-dynamic-card :card="$postData->postType()" class="card-horizontal" :postData="$postData" :displayDate="$attributes->displayDate()" :displayExcerpt="$attributes->displayExcerpt()" :displayImage="$attributes->displayImage()"
				:displayLabel="$attributes->displayLabel()" />
		@empty
			<x-alert type="warning" class="col-span-12">
				Geen resultaten gevonden.
			</x-alert>
		@endforelse
	</div>
</div>
