@php
	/**
	 * @var Log1x\Navi\Navi $topBarNavigation
	 */
@endphp

@if ($topBarNavigation->isNotEmpty())
	<div class="top-bar h-(--top-bar-height) hidden bg-gray-100 text-sm lg:flex">
		<x-brave::nav class="container flex h-full items-center justify-end"
			aria-label="{{ __('Secundaire navigatie', 'sage') }}">
			<x-brave::nav.list class="list-reset flex items-center gap-4">
				@foreach ($topBarNavigation->all() as $item)
					<x-brave::nav.item>
						<x-brave::nav.link :item="$item" @class([
							'text-current no-underline hover:text-primary focus:underline',
							'text-primary' => $item->active,
						])>
							{!! $item->label !!}
						</x-brave::nav.link>
					</x-brave::nav.item>
				@endforeach
			</x-brave::nav.list>
		</x-brave::nav>
	</div>
@endif
