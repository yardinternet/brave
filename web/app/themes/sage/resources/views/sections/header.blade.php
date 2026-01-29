<header id="js-brave-header"
	class="header justify shadow-xs headroom-pinned:translate-y-0 headroom-unpinned:-translate-y-full fixed z-50 w-full bg-white transition-transform duration-500">
	<x-header.top-bar />

	<div class="h-(--nav-bar-height) container flex items-center justify-between gap-x-3 lg:items-stretch lg:gap-x-4">
		<x-header.site-branding />

		<x-header.navigation />

		<x-header.search-bar />

		<x-header.mobile-menu />
	</div>
</header>
