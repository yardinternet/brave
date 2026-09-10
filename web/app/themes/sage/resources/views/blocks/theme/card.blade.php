<article {!! $blockWrapperAttributes !!}>
	<div class="{{ $blockDefaultClassname }}__body">
		{!! $content !!}
	</div>
	@if (($attributes['imageId'] ?? 0) > 0)
		@php($imageSrc = wp_get_attachment_image_url($attributes['imageId'], 'large'))
		<x-brave-img-focal-point class="{{ $blockDefaultClassname }}__image" :id="$attributes['imageId']" :src="$imageSrc" />
	@endif
</article>
