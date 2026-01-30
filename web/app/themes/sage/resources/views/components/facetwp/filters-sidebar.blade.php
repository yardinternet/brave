@props([
    'facets' => [],
])

@if (!empty($facets))
	<a class="is-button on-focus-visible" href="#js-brave-facetwp-template-view">
		Sla filters over
	</a>

	<x-facetwp.mobile-filters :facets="$facets" />

	<div
		class="bg-(--filters-sidebar-bg-color) rounded-(--filters-sidebar-radius) p-(--filters-sidebar-padding) shadow-(--filters-sidebar-shadow) hidden lg:block">
		<h2 class="sr-only">Filters</h2>
		<x-facetwp.filters :facets="$facets" />
		<x-facetwp.reset-button />
	</div>
@endif
