<article {!! $blockWrapperAttributes !!}>
	<div>
		{!! $content !!}
	</div>
	@if (($attributes['imageId'] ?? 0) > 0)
		@php($imageSrc = wp_get_attachment_image_url($attributes['imageId'], 'large'))
		<x-brave-img-focal-point :id="$attributes['imageId']" :src="$imageSrc" />
	@endif
</article>
