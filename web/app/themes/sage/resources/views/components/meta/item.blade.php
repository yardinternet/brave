@props([
    'icon' => 'fa-info-circle',
    'text' => '',
    'url' => '',
])

<li {{ $attributes->merge(['class' => 'meta-item flex items-baseline gap-x-4 gap-y-2']) }}>
	<i class="fa-light text-primary fa-fw {!! $icon !!} min-w-5"></i>

	@if ($url)
		<a href="{{ $url }}" class="hocus:underline text-inherit no-underline">
			{!! $text !!}
		</a>
	@else
		{!! $text !!}
	@endif
</li>
