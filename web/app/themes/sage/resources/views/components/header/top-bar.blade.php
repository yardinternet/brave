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
						<li>
							<a @class([
								'text-current no-underline hover:text-current hover:underline',
								'text-primary' => $item->active,
							]) href="{{ esc_url($item->url) }}"
								@if ($item->active) aria-current="page" @endif>
								{{ $item->label }}
							</a>
						</li>
					@endforeach
				</ul>
			</nav>
		</div>
	</div>
@endif
