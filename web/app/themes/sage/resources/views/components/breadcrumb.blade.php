@if ($items->isNotEmpty())
	<nav aria-label="Broodkruimelpad" class="brave-breadcrumb">
		<ol class="brave-breadcrumb-list align-items-center flex list-none flex-wrap pl-0"
			itemtype="https://schema.org/BreadcrumbList" itemscope>
			@foreach ($items as $item)
				<li class="brave-breadcrumb-item" itemprop="itemListElement" itemtype="https://schema.org/ListItem" itemscope
					{{ $loop->last ? 'aria-current="page"' : '' }}>
					@if (!$loop->first)
						<svg class="h-5 w-5 flex-shrink-0 text-red-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
							aria-hidden="true" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd"
								d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
								clip-rule="evenodd" />
						</svg>
					@endif
					@if (!empty($item['url']))
						<a class="brave-breadcrumb-item-link" href="{{ $item['url'] }}" itemprop="item"
							itemtype="https://schema.org/WebPage" itemscope>
							<span class="brave-breadcrumb-item-link-span" itemprop="name">
								{!! $item['label'] !!}
							</span>
						</a>
					@else
						<span class="brave-breadcrumb-item-active" itemprop="name">
							{{ $item['label'] }}
						</span>
					@endif
					<meta itemprop="position" content="{{ $loop->iteration }}">
				</li>
			@endforeach
		</ol>
	</nav>
@endif
