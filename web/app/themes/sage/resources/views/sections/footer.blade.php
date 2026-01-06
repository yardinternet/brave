<footer class="footer">
	<x-brave-pattern-content slug="footer" />

	@if (has_nav_menu('footer_navigation') || $cookieLawPluginActive)
		<div class="border-t-2 border-gray-100 py-4">
			<div class="container flex flex-wrap gap-x-3 gap-y-1">
				@if ($cookieLawPluginActive)
					<button class="cky-banner-element hocus:underline text-sm">Cookievoorkeuren wijzigen</button>
				@endif

				@if (has_nav_menu('footer_navigation'))
					@php
						wp_nav_menu([
						    'container' => '',
						    'depth' => 1,
						    'id' => '',
						    'menu_class' => 'footer-menu flex flex-wrap items-center list-none h-full m-0 p-0 gap-x-3 gap-y-1',
						    'theme_location' => 'footer_navigation',
						]);
					@endphp
				@endif
			</div>
		</div>
	@endif
</footer>
