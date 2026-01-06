@props([
    'facets' => [],
])

@if (!empty($facets))
	<h2 class="sr-only">Filters</h2>

	<a class="is-button on-focus-visible" href="#js-brave-facetwp-template-view">
		Sla filters over
	</a>

	<x-brave-accordion>
		<x-brave::accordion.item>
			<x-brave::accordion.item.trigger class="is-button w-full lg:hidden">
				<i class="fa-light fa-sliders mr-2" aria-hidden="true"></i>
				Filters
			</x-brave::accordion.item.trigger>

			<x-brave::accordion.item.panel class="lg:!block lg:!h-auto lg:overflow-visible">
				<div class="mt-3 lg:mt-0">
					@foreach ($facets as $facet)
						<fieldset>
							<legend class="mb-2">
								<h3 class="mb-0">{{ $facet['label'] }}</h3>
							</legend>
							{!! facetwp_display('facet', $facet['name']) !!}
						</fieldset>
					@endforeach

					<x-facetwp.reset-button />
				</div>
			</x-brave::accordion.item.panel>
		</x-brave::accordion.item>
	</x-brave-accordion>
@endif
