<div
	class="search-bar-container after:ease-base after:content ml-auto flex h-full items-center duration-300 after:pointer-events-none after:fixed after:inset-0 after:h-screen after:w-screen after:bg-black/[0] after:transition-all lg:ml-0">
	<button id="js-search-bar-open-btn"
		class="search-bar-open-btn ease-base lg:hocus:bg-primary-100 flex h-[46px] flex-col items-center justify-center gap-y-2 rounded-full border-0 bg-transparent text-2xl transition-all duration-500 lg:min-h-[56px] lg:min-w-[56px] lg:p-3"
		aria-label="{{ __('Open zoekbalk', 'sage') }}">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 lg:size-6">
			<path
				d="M384 208A176 176 0 1 0 32 208a176 176 0 1 0 352 0zM343.3 366C307 397.2 259.7 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 51.7-18.8 99-50 135.3L507.3 484.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L343.3 366z" />
		</svg>
		<span class="mt-auto text-xs leading-none lg:hidden">{{ __('Zoeken', 'sage') }}</span>
	</button>
	<div id="js-search-bar"
		class="search-bar h-(--combined-bar-height) invisible absolute inset-0 z-50 -translate-y-full bg-white px-3 opacity-0 shadow-md transition-all duration-500 ease-out">
		<form class="flex h-full w-full items-center justify-center gap-2" method="get"
			action="{{ esc_url(home_url('/')) }}">
			<input id="js-search-bar-input"
				class="search-bar-input focus:border-b-primary active:border-b-primary !h-14 w-full !rounded-none border-0 border-b-2 border-b-gray-500 bg-white px-3 py-4 !text-[1rem] !shadow-none md:w-[600px] md:!text-lg lg:!text-2xl"
				name="s" type="text" placeholder="{{ __('Typ om te zoeken...', 'sage') }}"
				aria-label="{{ __('Type om te zoeken', 'sage') }}" value="{{ get_search_query() }}" autofocus />
			<button
				class="search-bar-search-btn ease-base hocus:bg-primary-700 bg-primary min-h-10 min-w-10 rounded-full border-0 text-lg text-white transition-all duration-500 md:size-14 lg:text-2xl"
				aria-label="{{ __('Zoeken', 'sage') }}" type="submit">
				<i class="fa-light fa-search" aria-hidden="true"></i>
			</button>
			<button id="js-search-bar-close-btn"
				class="search-bar-close-btn ease-base hocus:bg-primary-100 min-h-10 min-w-10 rounded-full border-0 bg-transparent text-lg transition-all duration-500 md:size-14 lg:text-2xl"
				aria-label="{{ __('Sluit zoekbalk', 'sage') }}" type="button">
				<i class="fa-light fa-times" aria-hidden="true"></i>
			</button>
		</form>
	</div>
</div>
