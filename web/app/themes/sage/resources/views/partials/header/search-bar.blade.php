@php
	$dialogId = 'js-brave-search-bar';
@endphp

<x-brave::dialog.trigger :dialogId="$dialogId"
	class="search-bar-open-btn ease-base lg:hocus:bg-primary-100 ml-auto flex h-[46px] flex-col items-center justify-center gap-y-2 border-0 bg-transparent text-2xl transition-all duration-500 lg:ml-0 lg:min-h-[56px] lg:min-w-[56px] lg:self-center lg:rounded-full lg:p-3"
	aria-label="{{ __('Open zoekbalk om te zoeken', 'sage') }}">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 lg:size-6">
		<path
			d="M384 208A176 176 0 1 0 32 208a176 176 0 1 0 352 0zM343.3 366C307 397.2 259.7 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 51.7-18.8 99-50 135.3L507.3 484.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L343.3 366z" />
	</svg>
	<span class="mt-auto text-xs leading-none lg:hidden">{{ __('Zoeken', 'sage') }}</span>
</x-brave::dialog.trigger>

<x-brave-dialog :id="$dialogId" :ariaLabel="__('Zoekbalk', 'sage')" @class([
	'search-bar transition-discrete h-(--combined-bar-height) px-3 w-full max-w-full -translate-y-full bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
	'starting:open:-translate-y-full starting:open:opacity-0 starting:open:backdrop:bg-black/0',
	'open:translate-y-0 open:opacity-100 open:backdrop:bg-black/50',
])>
	<form class="flex h-full w-full items-center justify-center gap-2" method="get" action="{{ esc_url(home_url('/')) }}">
		<input id="js-brave-search-bar-input"
			class="search-bar-input rounded-none! shadow-none! h-14! md:text-lg! lg:text-2xl! w-full md:w-[600px]" name="s"
			type="text" placeholder="{{ __('Typ om te zoeken...', 'sage') }}"
			aria-label="{{ __('Type om te zoeken', 'sage') }}" value="{{ get_search_query() }}" autofocus />
		<button
			class="search-bar-search-btn ease-base hocus:bg-primary-700 bg-primary min-h-10 min-w-10 rounded-full border-0 text-lg text-white transition-all duration-500 md:size-14 lg:text-2xl"
			aria-label="{{ __('Zoeken', 'sage') }}" type="submit">
			<i class="fa-light fa-search" aria-hidden="true"></i>
		</button>
		<x-brave::dialog.trigger :dialogId="$dialogId"
			class="search-bar-close-btn ease-base hocus:bg-primary-100 min-h-10 min-w-10 rounded-full border-0 bg-transparent text-lg transition-all duration-500 md:size-14 lg:text-2xl"
			aria-label="{{ __('Sluit zoekbalk', 'sage') }}">
			<i class="fa-light fa-times" aria-hidden="true"></i>
		</x-brave::dialog.trigger>
	</form>
</x-brave-dialog>
