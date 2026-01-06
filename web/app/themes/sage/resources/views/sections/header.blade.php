<header id="js-header"
	class="header justify shadow-xs headroom-pinned:translate-y-0 headroom-unpinned:-translate-y-full fixed z-50 w-full bg-white transition-transform duration-500">
	@include('partials.header.top-bar')

	<div class="h-(--nav-bar-height) container flex items-center justify-between gap-x-3 lg:items-stretch lg:gap-x-4">
		@include('partials.header.site-branding')

		@include('partials.header.navigation')

		@include('partials.header.search-bar')

		@include('partials.header.hamburger')
	</div>
</header>

@include('partials.header.mobile-menu')
