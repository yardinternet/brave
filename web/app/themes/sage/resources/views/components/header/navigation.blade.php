@php
	$menu = Navi::build('primary_navigation');
@endphp

@if ($menu->isNotEmpty())
	<nav class="nav-primary hidden items-center lg:flex" aria-label="{{ __('Primaire navigatie', 'sage') }}">
		<ul class="nav mb-0 flex h-full list-none items-center justify-center pl-0">
			@foreach ($menu->all() as $item)
				<li @class([
					'menu-item group relative h-full',
					'menu-item-has-children' => $item->children,
				])>
					<a href="{{ $item->url }}" @class([
						'relative flex h-full items-center px-2 text-center text-sm leading-snug text-black no-underline xl:px-4 xl:text-base xl:leading-snug hocus:text-primary',
						'text-primary' => $item->active || $item->activeParent,
						$item->classes,
					])>
						{{ $item->label }}

						@if ($item->children)
							<i class="fa-light fa-chevron-down pl-2"></i>
						@endif
					</a>

					<span @class([
						'bg-primary ease-base absolute bottom-0 left-2 h-1 w-[calc(100%-1rem)] duration-300 xl:left-4 xl:w-[calc(100%-2rem)] invisible scale-0 group-hocus:visible group-hocus:scale-100',
						'visible scale-100' => $item->active || $item->activeParent,
					]) aria-hidden="true"></span>

					@if ($item->children)
						<ul
							class="sub-menu ease-base invisible absolute mb-0 min-w-48 -translate-y-3 list-none bg-white pl-0 opacity-0 shadow-md transition-all group-[.js-brave-show-sub-menu]:visible group-[.js-brave-show-sub-menu]:translate-y-0 group-[.js-brave-show-sub-menu]:opacity-100">
							@foreach ($item->children as $child)
								<li class="menu-item">
									<a href="{{ $child->url }}" @class([
										'group/child flex items-center px-6 py-3 text-left leading-snug text-inherit no-underline',
										'text-primary' => $child->active,
									])>
										{{ $child->label }}
										<i class="fa-light fa-angle-right ml-auto pl-6 transition-all group-hover/child:translate-x-1"></i>
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
