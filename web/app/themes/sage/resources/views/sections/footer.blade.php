@php
	/**
	 * @var Log1x\Navi\Navi $footerNavigation
	 */
@endphp

<footer class="footer">
	<x-brave-pattern-content slug="footer" />

	@if ($cookieLawPluginActive || $footerNavigation->isNotEmpty())
		<div class="border-t-2 border-gray-100 py-4 text-sm">
			<x-brave::nav class="container" aria-label="{{ __('Footer navigatie', 'sage') }}">
				<x-brave::nav.list class="list-reset flex flex-wrap gap-x-3 gap-y-2">
					@if ($cookieLawPluginActive)
						<x-brave::nav.item class="not-last:after:content-['|'] flex gap-x-3">
							<button class="cky-banner-element hover:text-primary focus:underline">
								{{ __('Cookievoorkeuren wijzigen', 'sage') }}
							</button>
						</x-brave::nav.item>
					@endif
					@foreach ($footerNavigation->all() as $item)
						<x-brave::nav.item class="not-last:after:content-['|'] flex gap-x-3">
							<x-brave::nav.link :item="$item" class="text-current no-underline focus:underline" activeClass="text-primary">
								{!! $item->label !!}
							</x-brave::nav.link>
						</x-brave::nav.item>
					@endforeach
				</x-brave::nav.list>
			</x-brave::nav>
		</div>
	@endif
</footer>
