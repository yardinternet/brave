@php
	/**
	 * @var Log1x\Navi\Navi $footerNavigation
	 */
@endphp

<footer class="footer">
	<x-brave-pattern-content slug="footer" />

	@if ($cookieLawPluginActive || $footerNavigation->isNotEmpty())
		<div class="border-t-2 border-gray-100 py-4 text-sm">
			<nav class="container" aria-label="{{ __('Footer navigatie', 'sage') }}">
				<ul class="list-reset flex flex-wrap gap-x-3 gap-y-2">
					@if($cookieLawPluginActive)
						<li class="flex gap-x-3 not-last:after:content-['|']">
							<button
								class="cky-banner-element hocus:underline">{{ __('Cookievoorkeuren wijzigen', 'sage') }}</button>
						</li>
					@endif
					@foreach($footerNavigation->all() as $item)
						@php($isActive = $item->active || $item->activeParent)
						<li class="flex gap-x-3 not-last:after:content-['|']">
							<a class="text-current no-underline hover:underline hover:text-current aria-current-page:underline"
								href="{{ esc_url($item->url) }}"
								@if($isActive) aria-current="page" @endif>{{ $item->label }}</a>
						</li>
					@endforeach
				</ul>
			</nav>
		</div>
	@endif
</footer>
