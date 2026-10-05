@php
	/**
	 * @var array $attributes
	 * @var string $blockClassName
	 * @var string $content
	 */
@endphp

<div {!! get_block_wrapper_attributes() !!}>
	{!! $content !!}
</div>
