@php
	/**
	 * @var array $attributes
	 * @var string $blockClassName
	 * @var string $content
	 */
@endphp

<article {!! get_block_wrapper_attributes() !!}>
	{!! $content !!}
</article>
