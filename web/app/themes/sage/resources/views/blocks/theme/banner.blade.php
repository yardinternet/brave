@php
	/**
	 * @var string $blockClassName
	 * @var string $content
	 * @var string $image
	 */
@endphp

<div {!! get_block_wrapper_attributes(['class' => 'alignfull']) !!}>
	<div class="{{ $blockClassName }}__container">
		<div class="{{ $blockClassName }}__content">
			{!! $content !!}
		</div>
		@if ($image)
			<div class="{{ $blockClassName }}__image-container">
				{!! $image !!}
			</div>
		@endif
	</div>
</div>
