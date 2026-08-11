@php
	/**
	 * @var Log1x\Navi\Navi $primaryNavigation
	 */
@endphp

@if ($primaryNavigation->isNotEmpty())
	<x-brave::nav class="hidden items-center lg:flex" aria-label="{{ __('Primaire navigatie', 'sage') }}">
		<x-brave::nav.list class="nav flex h-full items-center justify-center gap-x-4 xl:gap-x-8">
			@foreach ($primaryNavigation->all() as $item)
				<x-brave::nav.item class="group relative h-full">
					<x-brave::nav.link :item="$item"
						class="hocus:text-primary relative flex h-full items-center gap-2 text-center text-sm leading-snug text-black no-underline xl:text-base xl:leading-snug"
						activeClass="text-primary">

						{!! $item->label !!}

						@if ($item->children)
							<svg class="pointer-events-none size-3.5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 448 512">
								<path
									d="M235.3 411.3c-6.2 6.2-16.4 6.2-22.6 0l-208-208c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L224 377.4 420.7 180.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-208 208z" />
							</svg>
						@endif

						<span @class([
							'bg-primary ease-base absolute bottom-0 w-full left-0 h-1 duration-300 invisible scale-0 group-hover:visible group-hover:scale-100',
							'visible scale-100' => $item->active || $item->activeParent,
						]) aria-hidden="true"></span>
					</x-brave::nav.link>

					@if ($item->children)
						@if (count($item->children) > 7)
							<x-header.mega-dropdown :item="$item" />
						@else
							<x-header.dropdown :item="$item" />
						@endif
					@endif
				</x-brave::nav.item>
			@endforeach
		</x-brave::nav.list>
	</x-brave::nav>
@endif
