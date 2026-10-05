@php
	/**
	 * @var string $blockClassName
	 * @var string $content
	 * @var int $imageId
	 * @var string $focalPointStyle
	 */
@endphp

<article {!! get_block_wrapper_attributes() !!}>
	<div class="{{ $blockClassName }}__body">
		{!! $content !!}
	</div>
	@if ($imageId)
		{!! wp_get_attachment_image($imageId, 'large', false, [
		    'class' => "{$blockClassName}__image",
		    'style' => $focalPointStyle,
		]) !!}
	@endif
</article>
