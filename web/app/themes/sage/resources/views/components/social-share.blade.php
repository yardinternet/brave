@props([
    'icons' => ['x-twitter', 'facebook', 'linkedin', 'whatsapp', 'mail', 'web-share-api'],
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-2']) }}>
	<p class="mb-0 mr-2">Delen via:</p>

	@foreach ($icons as $type)
		<x-brave-social-icon :type="$type"
			class="text-primary-500 hocus:bg-primary-500 bg-primary-100 hocus:text-white flex size-10 items-center justify-center rounded-theme no-underline transition-[transform,visibility] duration-300" />
	@endforeach
</div>
