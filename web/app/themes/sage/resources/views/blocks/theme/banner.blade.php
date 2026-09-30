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
			<div class="{{ $blockDefaultClassname }}__media">
				{!! wp_get_attachment_image($attributes['imageId'], 'large', false, [
					'class' => $blockDefaultClassname . '__image',
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
