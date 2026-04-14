@props([
    'facets' => [],
    'dialogId' => 'js-brave-facetwp-mobile-filters',
    'label' => __('Filters', 'sage'),
])

<x-brave::dialog.trigger :dialogId="$dialogId" class="is-button z-50 w-full justify-center lg:hidden">
	<i class="fa-light fa-sliders" aria-hidden="true"></i>
	{{ $label }}
</x-brave::dialog.trigger>

<x-brave-dialog :id="$dialogId" :ariaLabel="$label" @class([
	'transition-discrete z-1 max-h-3/4 mt-auto h-fit w-full max-w-full transform-[translateY(100%)] rounded-t-lg bg-white opacity-0 transition-all duration-500',
	'backdrop:transition-discrete backdrop:pointer-events-none backdrop:bg-black/0 backdrop:transition-all backdrop:duration-500',
	'starting:open:transform-[translateY(100%)] starting:open:opacity-0 starting:open:backdrop:bg-black/0',
	'open:transform-[translateY(0)] open:opacity-100 open:backdrop:bg-black/50',
])>
	<div class="flex flex-col">
		<div class="z-2 sticky top-0 flex items-center justify-between gap-2 border-b border-gray-100 bg-white p-4">
			<h2 class="mb-0 text-base font-normal">{{ $label }}</h2>
			<x-brave::dialog.trigger :dialogId="$dialogId"
				class="leading-0 -m-2 flex size-[46px] items-center justify-center text-2xl">
				<i class="fa-light fa-xmark" aria-hidden="true"></i>
				<span class="sr-only">{{ __('Sluit filters', 'sage') }}</span>
			</x-brave::dialog.trigger>
		</div>

		<div class="mb-8 flex flex-col gap-8 p-4">
			<x-facetwp.filters :facets="$facets" />
		</div>

		<div class="z-2 sticky bottom-4 mt-auto flex gap-2 px-4">
			<x-facetwp.reset-button />

			<x-brave::dialog.trigger :dialogId="$dialogId" class="is-button w-full justify-center">
				{{ __('Bekijk resultaten', 'sage') }}
			</x-brave::dialog.trigger>
		</div>
	</div>
</x-brave-dialog>
