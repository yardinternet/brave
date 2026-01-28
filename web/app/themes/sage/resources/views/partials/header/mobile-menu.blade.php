@php
	$dialogId = 'js-brave-mobile-menu';
	$label = __('Menu', 'sage');
@endphp

<x-brave::dialog.trigger :dialogId="$dialogId" class="hamburger group flex h-[46px] flex-col gap-y-2 lg:hidden">
	<span
		class="block h-0.5 w-8 rounded-full bg-black transition-all duration-300 ease-in-out group-aria-expanded:w-8 group-aria-expanded:translate-y-3 group-aria-expanded:rotate-45"></span>
	<span
		class="block h-0.5 w-6 rounded-full bg-black transition-all duration-300 ease-in-out group-aria-expanded:scale-0"></span>
	<span
		class="block h-0.5 w-4 rounded-full bg-black transition-all duration-300 ease-in-out group-aria-expanded:w-8 group-aria-expanded:-translate-y-2 group-aria-expanded:-rotate-45"></span>
	<span class="mt-auto text-xs leading-none">{{ $label }}</span>
</x-brave::dialog.trigger>

<x-brave-dialog :id="$dialogId" :ariaLabel="$label" @class([
	'mobile-menu transition-discrete top-0 bottom-0 left-10 right-0 h-full max-h-full w-auto max-w-full translate-x-full bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
	'starting:open:translate-x-full starting:open:opacity-0 starting:open:backdrop:bg-black/0',
	'open:translate-x-0 open:opacity-100 open:backdrop:bg-black/50',
])>
	<div class="flex h-full flex-col">
		<div class="z-1 sticky top-0 flex items-center justify-between gap-2 border-b border-gray-100 bg-white p-4">
			<h2 class="mb-0 text-base font-normal">{{ $label }}</h2>
			<x-brave::dialog.trigger :dialogId="$dialogId"
				class="leading-0 -m-2 flex size-[46px] items-center justify-center text-2xl">
				<i class="fa-light fa-xmark" aria-hidden="true"></i>
				<span class="sr-only">Sluit menu</span>
			</x-brave::dialog.trigger>
		</div>

		@php
			if (has_nav_menu('primary_navigation')) {
			    wp_nav_menu([
			        'container' => '',
			        'depth' => 2,
			        'id' => '',
			        'menu_class' => 'mobile-menu-navigation w-full mb-0 list-none px-4',
			        'theme_location' => 'primary_navigation',
			    ]);
			}

			if (has_nav_menu('top_bar_navigation')) {
			    wp_nav_menu([
			        'container' => '',
			        'depth' => 1,
			        'id' => '',
			        'menu_class' => 'mobile-menu-navigation mobile-menu-top-bar w-full mb-0 list-none px-4',
			        'theme_location' => 'top_bar_navigation',
			    ]);
			}
		@endphp
	</div>
</x-brave-dialog>
