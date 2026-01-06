@props([
    'class' => '',
    'label' => 'Reset filters',
])

<button
	{{ $attributes->merge(['class' => 'js-brave-facetwp-btn-reset is-button is-button-primary-100 !is-button-small group flex w-full items-center justify-center gap-2 lg:w-fit']) }}
	onclick="FWP.reset()">
	<i class="fa-regular fa-redo-alt transition-all duration-300 group-hover:rotate-[320deg]" aria-hidden="true"></i>
	{{ $label }}
</button>
