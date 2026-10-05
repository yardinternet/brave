@php
	/**
	 * @var string $blockClassName
	 * @var string $content
	 * @var int $imageId
	 * @var string $focalPointStyle
	 */
@endphp

<div {!! get_block_wrapper_attributes(['class' => 'alignfull']) !!}>
	<div class="{{ $blockClassName }}__container">
		<div class="{{ $blockClassName }}__content">
			{!! $content !!}
		</div>
		@if ($imageId)
			<div class="{{ $blockClassName }}__image-container">
				{!! wp_get_attachment_image($imageId, 'full', false, [
				    'class' => "{$blockClassName}__image",
				    'style' => $focalPointStyle,
				]) !!}
			</div>
		@endif
	</div>
</div>
