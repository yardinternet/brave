@props([
    'label' => 'Je zoekopdracht heeft geen resultaten opgeleverd.',
])

<div
	{{ $attributes->merge([
	    'class' => 'facetwp-no-results col-span-full flex flex-col items-center justify-center',
	    'role' => 'alert',
	]) }}>
	<h2>{{ $label }}</h2>
	<x-facetwp.reset-button />
</div>
