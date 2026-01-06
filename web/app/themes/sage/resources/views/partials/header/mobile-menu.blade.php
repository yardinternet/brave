<div id="js-brave-mobile-menu"
	class="mobile-menu ease-base invisible fixed bottom-0 left-0 right-0 top-[calc(var(--nav-bar-height)+var(--wp-admin-bar-height))] z-40 w-full overflow-y-scroll bg-white opacity-0 transition-all duration-500">
	<div class="flex h-full flex-col items-start py-4">
		@php
			if (has_nav_menu('primary_navigation')) {
			    wp_nav_menu([
			        'container' => '',
			        'depth' => 2,
			        'id' => '',
			        'menu_class' => 'mobile-menu-navigation | w-full mb-0 list-none px-4',
			        'theme_location' => 'primary_navigation',
			    ]);
			}

			if (has_nav_menu('top_bar_navigation')) {
			    wp_nav_menu([
			        'container' => '',
			        'depth' => 1,
			        'id' => '',
			        'menu_class' => 'mobile-menu-navigation mobile-menu-top-bar | w-full mt-6 mb-0 list-none px-4',
			        'theme_location' => 'top_bar_navigation',
			    ]);
			}
		@endphp
		<button id="js-brave-mobile-menu-close-btn" class="is-button on-focus-visible focus:!static">{{ __('Sluiten', 'sage') }}
		</button>
	</div>
</div>
