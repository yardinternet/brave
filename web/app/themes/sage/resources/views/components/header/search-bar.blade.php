@props([
    'dialogId' => 'js-brave-search-bar',
])

<x-brave::dialog.trigger :dialogId="$dialogId"
	class="search-bar-open-btn is-search-bar-trigger ease-base ml-auto flex min-h-[46px] flex-col items-center justify-center gap-y-2 text-2xl transition-colors duration-500 lg:ml-0 lg:self-center"
	aria-label="{{ __('Open zoekbalk om te zoeken', 'sage') }}">
	<span class="is-search-bar-trigger-icon lg:contents">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 fill-current lg:size-6">
			<path
				d="M384 208A176 176 0 1 0 32 208a176 176 0 1 0 352 0zM343.3 366C307 397.2 259.7 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 51.7-18.8 99-50 135.3L507.3 484.7c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L343.3 366z" />
		</svg>
	</span>
	<span class="[display:var(--search-bar-trigger-label-display)] mt-auto text-xs leading-none lg:hidden">{{ __('Zoeken', 'sage') }}</span>
</x-brave::dialog.trigger>

<x-brave-dialog :id="$dialogId" :ariaLabel="__('Zoekbalk', 'sage')" @class([
	'search-bar transition-discrete h-(--combined-bar-with-admin-bar-height) px-3 w-full max-w-full transform-[translateY(-100%)] bg-white opacity-0 transition-[transform,opacity,display,overlay] duration-400 ease-drawer',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-[background-color,display,overlay] backdrop:duration-400 backdrop:ease-drawer',
	'starting:open:transform-[translateY(-100%)] starting:open:opacity-0 starting:open:backdrop:bg-black/0',
	'open:transform-[translateY(0)] open:opacity-100 open:backdrop:bg-black/50',
])>
	<form class="flex h-full w-full items-center justify-center gap-x-2 sm:gap-x-4" method="get"
		action="{{ esc_url(home_url('/')) }}">
		<div class="relative w-full max-w-xl">
			<input id="js-brave-search-bar-input"
				class="search-bar-input rounded-none! shadow-none! border-0! border-b-2! border-primary! bg-white! h-14! pr-10! md:py-4! md:pl-3! md:text-lg! w-full"
				name="s" type="text" placeholder="{{ __('Typ om te zoeken...', 'sage') }}"
				aria-label="{{ __('Type om te zoeken', 'sage') }}" value="{{ get_search_query() }}" autofocus />
			<button
				class="search-bar-search-btn ease-base hocus:text-primary absolute right-0 top-1/2 size-8 -translate-y-1/2 border-0 bg-transparent transition-all duration-500 sm:text-lg xl:text-xl"
				aria-label="{{ __('Zoeken', 'sage') }}" type="submit">
				<i class="fa-light fa-search" aria-hidden="true"></i>
			</button>
		</div>
		<x-brave::dialog.trigger :dialogId="$dialogId"
			class="search-bar-close-btn ease-base hocus:text-primary size-8 shrink-0 border-0 bg-transparent transition-all duration-500 sm:text-lg xl:text-xl"
			aria-label="{{ __('Sluit zoekbalk', 'sage') }}">
			<i class="fa-light fa-times" aria-hidden="true"></i>
		</x-brave::dialog.trigger>
	</form>
</x-brave-dialog>
