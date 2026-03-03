@php
	/**
	 * @var Log1x\Navi\Navi $primaryNavigation
	 */
@endphp

@if ($primaryNavigation->isNotEmpty())
	<nav class="nav-primary hidden items-center lg:flex" aria-label="{{ __('Primaire navigatie', 'sage') }}">
		<ul class="nav list-reset flex h-full items-center justify-center gap-x-4 xl:gap-x-8">
			@foreach ($primaryNavigation->all() as $item)
				<li @class([
					'menu-item group relative h-full',
					'menu-item-has-children' => $item->children,
				])>
					<a href="{{ $item->url }}" @class([
						'relative flex h-full gap-2 items-center text-center text-sm leading-snug text-black no-underline xl:text-base xl:leading-snug hocus:text-primary',
						'text-primary' => $item->active || $item->activeParent,
						$item->classes,
					])
						@if ($item->active) aria-current="page" @endif>
						{{ $item->label }}

						@if ($item->children)
							<i class="fa-light fa-chevron-down"></i>
						@endif
					</a>

					<span @class([
						'bg-primary ease-base absolute bottom-0 w-full left-0 h-1 duration-300 invisible scale-0 group-hover:visible group-hover:scale-100',
						'visible scale-100' => $item->active || $item->activeParent,
					]) aria-hidden="true"></span>

					@if ($item->children)
						<ul
							class="sub-menu list-reset ease-base group-has-aria-expanded:visible group-has-aria-expanded:translate-y-0 group-has-aria-expanded:opacity-100 invisible absolute min-w-48 -translate-y-3 bg-white opacity-0 shadow-md transition-all">
							@foreach ($item->children as $child)
								<li class="menu-item">
									<a href="{{ $child->url }}" @class([
										'group/sub-link flex items-center gap-6 justify-between px-6 py-3 text-left leading-snug text-inherit no-underline',
										'text-primary' => $child->active,
										$child->classes,
									])
										@if ($child->active) aria-current="page" @endif>
										{{ $child->label }}
										<i class="fa-light fa-angle-right transition-all group-hover/sub-link:translate-x-1"></i>
									</a>
								</li>
							@endforeach
						</ul>
					@endif
				</li>
			@endforeach
		</ul>
	</nav>
@endif
