@php
	/**
	 * @var array $attributes
	 * @var string $blockDefaultClassname
	 * @var string $blockWrapperAttributes
	 * @var string $content
	 */
@endphp

<div {!! $blockWrapperAttributes !!}>
	<div class="{{ $blockDefaultClassname }}__inner">
		<div class="{{ $blockDefaultClassname }}__content">
			{!! $content !!}
		</div>
		@if (($attributes['imageId'] ?? 0) > 0)
			@php($imageSrc = wp_get_attachment_image_url($attributes['imageId'], 'large'))
			<div class="{{ $blockDefaultClassname }}__media">
				<x-brave-img-focal-point class="{{ $blockDefaultClassname }}__image" :id="$attributes['imageId']" :src="$imageSrc" />
			</div>
		@endif
	</div>
</div>
