<x-layout>
	@isset($top)
		{{ $top }}
	@endisset

	@isset($article)
		<article @class(['layout-article', $attributes->get('class')])>
			{{ $article }}
		</article>
	@endisset

	@isset($bottom)
		{{ $bottom }}
	@endisset
</x-layout>
