@php
	/**
	 * @var string $blockClassName
	 * @var string $content
	 * @var string $image
	 */
@endphp

<article {!! get_block_wrapper_attributes() !!}>
	<div class="{{ $blockClassName }}__body">
		{!! $content !!}
	</div>
	{!! $image !!}
</article>
