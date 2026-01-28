@props([
    'facets' => [],
])

@foreach ($facets as $facet)
	<fieldset>
		<legend class="mb-2">
			<h3 class="mb-0">{{ $facet['label'] }}</h3>
		</legend>
		{!! facetwp_display('facet', $facet['name']) !!}
	</fieldset>
@endforeach
