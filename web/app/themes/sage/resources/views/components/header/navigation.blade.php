@php
	/**
	 * @var Log1x\Navi\Navi $primaryNavigation
	 */
@endphp

@if ($primaryNavigation->isNotEmpty())
	<x-brave::nav class="hidden items-center lg:flex" aria-label="{{ __('Primaire navigatie', 'sage') }}">
		<x-brave::nav.list class="nav list-reset flex h-full items-center justify-center gap-x-4 xl:gap-x-8">
			@foreach ($primaryNavigation->all() as $item)
				<x-brave::nav.item :item="$item" @class(['group relative h-full'])>
					<x-brave::nav.link :item="$item" @class([
						'relative flex h-full gap-2 items-center text-center text-sm leading-snug text-black no-underline xl:text-base xl:leading-snug hocus:text-primary',
						'text-primary' => $item->active || $item->activeParent,
					])>
						{!! $item->label !!}

						@if ($item->children)
							<i class="fa-light fa-chevron-down"></i>
						@endif
					</x-brave::nav.link>

					<span @class([
						'bg-primary ease-base absolute bottom-0 w-full left-0 h-1 duration-300 invisible scale-0 group-hover:visible group-hover:scale-100',
						'visible scale-100' => $item->active || $item->activeParent,
					]) aria-hidden="true"></span>

					@if ($item->children)
						<x-brave::nav.dropdown-on-hover @class([
							'list-reset ease-base invisible absolute min-w-60 -translate-y-3 bg-white opacity-0 shadow-md transition-all',
							'group-has-aria-expanded:visible group-has-aria-expanded:translate-y-0 group-has-aria-expanded:opacity-100',
						])>
							@foreach ($item->children as $child)
								<x-brave::nav.item :item="$child">
									<x-brave::nav.link :item="$child" @class([
										'group/sub-menu-link flex items-center gap-6 justify-between px-6 py-3 text-left leading-snug text-inherit no-underline',
										'text-primary' => $child->active,
									])>
										{!! $child->label !!}
										<i class="fa-light fa-angle-right transition-all group-hover/sub-menu-link:translate-x-1"></i>
									</x-brave::nav.link>
								</x-brave::nav.item>
							@endforeach
						</x-brave::nav.dropdown-on-hover>
					@endif
				</x-brave::nav.item>
			@endforeach
		</x-brave::nav.list>
	</x-brave::nav>
@endif
