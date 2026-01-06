@php
	$hasFacets ??= !empty($facets);
	$displayResultCount ??= true;
	$displaySelections ??= true;
	$resultCountFacet ??= 'result_count';
@endphp

<div class="grid grid-cols-12 gap-4 xl:gap-8">
	@if ($hasFacets)
		<div class="relative col-span-12 lg:col-span-4 xl:col-span-3">
			<x-facetwp.filters-sidebar :facets="$facets" />
		</div>
	@endif

	<div id="js-brave-facetwp-template-view" @class([
		'@container col-span-12 flex flex-col gap-4',
		'lg:col-span-8 xl:col-span-9' => $hasFacets,
	])>
		@if ($displayResultCount || ($hasFacets && $displaySelections))
			<div class="flex flex-col flex-wrap gap-y-2 lg:flex-row lg:items-center lg:justify-between">
				@if ($displayResultCount)
					<x-facetwp.result-count :facetName="$resultCountFacet" />
				@endif
				@if ($hasFacets && $displaySelections)
					<x-facetwp.selections />
				@endif
			</div>
		@endif

		{!! facetwp_display('template', $template['name']) !!}
		{!! facetwp_display('facet', 'pagination') !!}
	</div>
</div>
