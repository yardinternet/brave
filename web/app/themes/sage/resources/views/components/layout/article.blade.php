<x-layout>
	@isset($top)
		{{ $top }}
	@endisset

	@isset($article)
		<x-block-theme-article :class="$attributes->get('class')">
			{{ $article }}
		</x-block-theme-article>
	@endisset

	@isset($bottom)
		{{ $bottom }}
	@endisset
</x-layout>
