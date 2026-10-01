<x-layout>
	@isset($top)
		{{ $top }}
	@endisset

	@isset($article)
		@php
			// Temp, will be changed when <x-block-theme-article /> can be used
			$blockType = \WP_Block_Type_Registry::get_instance()->get_registered('theme/article');
			if ($blockType) {
			    foreach ([...$blockType->style_handles, ...$blockType->view_style_handles] as $handle) {
			        wp_enqueue_style($handle);
			    }
			}
		@endphp
		<article @class(['wp-block-theme-article', $attributes->get('class')])>
			{{ $article }}
		</article>
	@endisset

	@isset($bottom)
		{{ $bottom }}
	@endisset
</x-layout>
