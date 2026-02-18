@php
	/**
	 * @var Log1x\Navi\Navi $topBarNavigation
	 */
@endphp

@if ($topBarNavigation->isNotEmpty())
	<div class="top-bar h-(--top-bar-height) hidden bg-gray-100 text-sm lg:flex">
		<div class="container h-full">
			<nav class="flex h-full items-center justify-end" aria-label="{{ __('Secundaire navigatie', 'sage') }}">
				<ul class="list-reset flex items-center gap-4">
					@foreach ($topBarNavigation->all() as $item)
						@php($isActive = $item->active || $item->activeParent)
						<li>
							<a class="aria-current-page:underline text-current no-underline hover:text-current hover:underline"
								href="{{ esc_url($item->url) }}"
								@if ($isActive) aria-current="page" @endif>{{ $item->label }}</a>
						</li>
					@endforeach
				</ul>
			</nav>
		</div>
	</div>
@endif
