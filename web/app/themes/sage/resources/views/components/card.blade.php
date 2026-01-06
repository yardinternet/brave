<div
	{{ $attributes->merge([
	    'class' =>
	        $cardClass() .
	        ' group relative m-0 mt-0 flex h-full max-w-full flex-col rounded-theme border-none bg-white p-0 shadow transition-all',
	]) }}>

	@if ($displayImage)
		<div
			class="card-image-wrapper bg-primary-100 relative flex aspect-[16/9] min-w-full items-center justify-center rounded-t-theme">
			<x-brave-img-focal-point @class([
				'card-image aspect-[inherit] size-full object-cover',
				'card-image-logo !size-8 !object-contain' => $thumbnailIsLogo,
				'rounded-t-theme' => !$thumbnailIsLogo,
			]) :src="$thumbnailUrl ?: get_theme_file_uri('/resources/images/logo-element.svg')" :id="$postID" />
		</div>
	@endif

	<div class="card-body normalize-child-margin p-(--card-padding) flex h-full grow flex-col">
		<x-dynamic-tag :tag="$titleTag" class="card-title mb-2 md:mb-3">
			@if ($url)
				<a class="card-link a-linkable-area !text-inherit no-underline focus:underline" href="{{ $url }}">
					{!! $title !!}
				</a>
			@else
				{!! $title !!}
			@endif
		</x-dynamic-tag>

		@if ($subtitle)
			<p class="-mt-2 mb-3">{!! $subtitle !!}</p>
		@endif

		@if ($displayDate && $dateTime && $dateString)
			<time class="card-date -order-1 !mb-2 text-sm leading-none text-gray-500" datetime="{{ $dateTime }}">
				{{ $dateString }}
			</time>
		@endif

		@if ($displayExcerpt && $excerpt)
			<p class="card-excerpt mb-2">
				{!! $excerpt !!}
			</p>
		@endif

		@if ($displayLabel && $label)
			<div class="card-label bg-primary-100 mt-auto w-fit rounded-theme px-2 py-1 text-sm">
				{!! $label !!}
			</div>
		@endif
	</div>
</div>
