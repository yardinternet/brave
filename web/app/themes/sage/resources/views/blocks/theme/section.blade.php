@php
	/**
	 * @var array $attributes
	 * @var string $blockClassName
	 * @var string $content
	 */
@endphp

<section {!! get_block_wrapper_attributes(['class' => 'alignfull']) !!}>
	{!! $content !!}
</section>
