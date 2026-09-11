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
		{!! $content !!}
	</div>
</div>
