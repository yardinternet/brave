@use(App\View\Components\Card\Enums\Direction)

<div @class([
	'group relative m-0 flex h-full max-w-full rounded-(--card-radius) border-none bg-(--card-bg-color) p-0 shadow-(--card-shadow) transition-all',
	$cardClass(),
	'flex-col' => $direction->isColumn(),
	'flex-row' => $direction->isRow(),
	'flex-col md:flex-row!' => $direction->isFluid(),
])>

	@if ($displayImage)
		<div @class([
			'card-image-wrapper bg-primary-100  relative flex aspect-[16/9] items-center justify-center',
			'rounded-t-theme' => $direction->isColumn(),
			'w-1/3 min-w-1/3 rounded-l-theme' => $direction->isRow(),
			'md:w-1/3 md:min-w-1/3 rounded-t-theme md:rounded-t-none md:rounded-l-theme' => $direction->isFluid(),
		])>
			<x-brave-img-focal-point @class([
				'card-image aspect-[inherit] size-full object-cover',
				'card-image-logo !size-8 !object-contain' => $thumbnailIsLogo,
				'rounded-[inherit]' => !$thumbnailIsLogo,
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
			<div
				class="card-label rounded-(--card-label-radius) border-(length:--card-label-border-width) border-(--card-label-border-color) bg-(--card-label-bg-color) p-(--card-label-padding) text-(--card-label-color) font-(--card-label-font-weight) mt-auto w-fit text-sm">
				{!! $label !!}
			</div>
		@endif
	</div>
</div>
