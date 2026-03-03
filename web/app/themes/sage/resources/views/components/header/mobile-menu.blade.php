@props([
    'dialogId' => 'js-brave-mobile-menu',
    'label' => __('Menu', 'sage'),
])

@php
	/**
	 * @var Navi $primaryNavigation
	 * @var Navi $topBarNavigation
	 */

	use Log1x\Navi\Navi;
@endphp

<x-brave::dialog.trigger :dialogId="$dialogId" class="hamburger h-11.5 group flex flex-col gap-y-2 lg:hidden">
	<span
		class="block h-0.5 w-8 rounded-full bg-black transition-all duration-300 ease-in-out group-aria-expanded:w-8 group-aria-expanded:translate-y-3 group-aria-expanded:rotate-45"></span>
	<span
		class="block h-0.5 w-6 rounded-full bg-black transition-all duration-300 ease-in-out group-aria-expanded:scale-0"></span>
	<span
		class="block h-0.5 w-4 rounded-full bg-black transition-all duration-300 ease-in-out group-aria-expanded:w-8 group-aria-expanded:-translate-y-2 group-aria-expanded:-rotate-45"></span>
	<span class="mt-auto text-xs leading-none">{{ $label }}</span>
</x-brave::dialog.trigger>

<x-brave-dialog :id="$dialogId" :ariaLabel="$label" @class([
	'mobile-menu transition-discrete top-0 bottom-0 left-10 right-0 h-full max-h-full w-auto max-w-full transform-[translateX(100%)] bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
	'starting:open:transform-[translateX(100%)] starting:open:opacity-0 starting:open:backdrop:bg-black/0',
	'open:transform-[translateX(0)] open:opacity-100 open:backdrop:bg-black/50',
])>
	<div class="flex h-full flex-col">
		<div class="z-1 sticky top-0 flex items-center justify-between gap-2 border-b border-gray-100 bg-white p-4">
			<h2 class="mb-0 text-base font-normal">{{ $label }}</h2>
			<x-brave::dialog.trigger :dialogId="$dialogId" class="leading-0 size-11.5 -m-2 flex items-center justify-center text-2xl">
				<i class="fa-light fa-xmark" aria-hidden="true"></i>
				<span class="sr-only">Sluit menu</span>
			</x-brave::dialog.trigger>
		</div>

		@if ($primaryNavigation->isNotEmpty())
			<ul class="mobile-menu-navigation list-reset mb-6 px-4">
				@foreach ($primaryNavigation->all() as $item)
					@php
						$hasChildren = !empty($item->children);
					@endphp

					<li @class([
						'menu-item group',
						{{-- menu-item-has-children => Now a trigger for MobileMenu. Reset to brave-menu-item-has-children --}}
						"menu-item-has-children" => $hasChildren,
					])>
						<a @class([
							'block py-3 text-base text-black no-underline focus:text-inherit',
							'text-primary font-bold' => $item->active || $item->activeParent,
							"after:fontawesome after:inline-flex after:px-2 after:transition-all after:content-['\\f107']! group-has-aria-expanded:after:rotate-180" => $hasChildren,
						]) href="{{ $hasChildren ? '#' : esc_url($item->url) }}"
							@if ($item->active) aria-current="page" @endif>{{ $item->label }}</a>
						@if ($hasChildren)
							<ul class="sub-menu list-reset mb-2 hidden list-none px-3 group-has-aria-expanded:block!">
								@foreach ($item->children as $child)
									<li class="menu-item">
										<a @class([
											'block py-1 text-sm text-gray-700 no-underline',
											'text-primary' => $child->active,
										]) href="{{ esc_url($child->url) }}"
											@if ($child->active) aria-current="page" @endif>{{ $child->label }}</a>
									</li>
								@endforeach
							</ul>
						@endif
					</li>
				@endforeach
			</ul>
		@endif

		@if ($topBarNavigation->isNotEmpty())
			<ul class="list-reset grid gap-2 px-4 text-sm text-gray-700">
				@foreach ($topBarNavigation->all() as $item)
					<li>
						<a class="aria-current-page:underline text-current no-underline hover:text-current"
							href="{{ esc_url($item->url) }}"
							@if ($item->active) aria-current="page" @endif>{{ $item->label }}</a>
					</li>
				@endforeach
			</ul>
		@endif
	</div>
</x-brave-dialog>
