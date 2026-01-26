@props([
    'isColumnReverseMobile' => false,
])

<x-layout>
	@isset($top)
		{{ $top }}
	@endisset

	<div @class([
		'layout-article-aside',
		'max-md:flex-col-reverse' => $isColumnReverseMobile,
		$attributes->get('class'),
	])>
		@isset($article)
			<article @class([
				'layout-article-aside__article',
				$article->attributes['class'],
			])>
				{{ $article }}
			</article>
		@endisset

		@isset($aside)
			<aside @class(['layout-article-aside__aside', $aside->attributes['class']])>
				{{ $aside }}
			</aside>
		@endisset
	</div>

	@isset($bottom)
		{{ $bottom }}
	@endisset
</x-layout>
