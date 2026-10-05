@php
	/**
	 * @var array $attributes
	 * @var string $blockClassName
	 * @var string $blockWrapperAttributes
	 * @var string $content
	 */
@endphp

<div {!! $blockWrapperAttributes !!}>
	<div class="{{ $blockClassName }}__container">
		<div class="{{ $blockClassName }}__content">
			{!! $content !!}
		</div>
		@if (($attributes['imageId'] ?? 0) > 0)
			<div class="{{ $blockClassName }}__image-container">
				{!! wp_get_attachment_image($attributes['imageId'], 'large', false, [
				    'class' => $blockClassName . '__image',
				    'style' => sprintf(
				        'object-position: %d%% %d%%;',
				        min(max((float) ($attributes['focalPoint']['x'] ?? 0.5), 0), 1) * 100,
				        min(max((float) ($attributes['focalPoint']['y'] ?? 0.5), 0), 1) * 100,
				    ),
				]) !!}
			</div>
		@endif
	</div>
</div>
