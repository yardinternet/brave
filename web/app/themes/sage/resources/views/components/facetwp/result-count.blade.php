@props([
    'facetName' => 'result_count',
])

<h2
	{{ $attributes->merge([
	    'class' => 'facetwp-result-count-container mb-0 flex lg:min-h-8 items-center font-sans text-base font-normal',
	    'aria-live' => 'polite',
	]) }}>
	{!! facetwp_display('facet', $facetName) !!}
</h2>
