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
	'mobile-menu transition-discrete top-0 bottom-0 left-10 right-0 h-full max-h-full w-auto max-w-full translate-x-full bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
	'starting:open:translate-x-full starting:open:opacity-0 starting:open:backdrop:bg-black/0',
	'open:translate-x-0 open:opacity-100 open:backdrop:bg-black/50',
])>
	<div class="flex h-full flex-col">
		<div class="z-1 sticky top-0 flex items-center justify-between gap-2 border-b border-gray-100 bg-white px-6 py-4">
			<h2 class="mb-0 text-base font-normal">{{ $label }}</h2>
			<x-brave::dialog.trigger :dialogId="$dialogId" class="leading-0 size-11.5 -m-2 flex items-center justify-center text-2xl">
				<i class="fa-light fa-xmark" aria-hidden="true"></i>
				<span class="sr-only">Sluit menu</span>
			</x-brave::dialog.trigger>
		</div>

		<x-brave::nav class="px-6 py-8" aria-label="{{ __('Mobiele navigatie', 'sage') }}">
			@if ($primaryNavigation->isNotEmpty())
				<x-brave::nav.list class="list-reset mb-6">
					@foreach ($primaryNavigation->all() as $item)
						<x-brave::nav.item :item="$item" @class(['group'])>
							<x-brave::nav.link :item="$item" @class([
								'block py-3 text-lg text-black no-underline focus:text-inherit',
								'text-primary font-bold' => $item->active || $item->activeParent,
							])>
								{!! $item->label !!}
								@if ($item->children)
									<i class="fa-light fa-chevron-down group-has-aria-expanded:rotate-180 px-1 transition-all"></i>
								@endif
							</x-brave::nav.link>
							@if ($item->children)
								<x-brave::nav.dropdown-on-click @class([
									'list-reset group-has-aria-expanded:block! mb-2 hidden list-none px-3',
									'group-has-aria-expanded:block',
								])>
									@foreach ($item->children as $child)
										<x-brave::nav.item :item="$child">
											<x-brave::nav.link :item="$child" @class([
												'block py-2 text-gray-700 no-underline',
												'text-primary' => $child->active,
												$child->classes,
											])>
												{!! $child->label !!}
											</x-brave::nav.link>
										</x-brave::nav.item>
									@endforeach
								</x-brave::nav.dropdown-on-click>
							@endif
						</x-brave::nav.item>
					@endforeach
				</x-brave::nav.list>
			@endif

			@if ($topBarNavigation->isNotEmpty())
				<x-brave::nav.list class="list-reset grid">
					@foreach ($topBarNavigation->all() as $item)
						<x-brave::nav.item :item="$item">
							<x-brave::nav.link :item="$item" @class([
								'block text-gray-700 no-underline py-2',
								'text-primary' => $item->active,
								$item->classes,
							])>
								{{ $item->label }}
							</x-brave::nav.link>
						</x-brave::nav.item>
					@endforeach
				</x-brave::nav.list>
			@endif
		</x-brave::nav>
	</div>
</x-brave-dialog>
