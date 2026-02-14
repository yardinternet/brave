@if ($items->isNotEmpty())
	<nav aria-label="Broodkruimelpad" @class(['brave-breadcrumb', $attributes->get('class')])>
		<ol @class(['brave-breadcrumb-list', $listClass]) itemtype="https://schema.org/BreadcrumbList" itemscope>
			@foreach ($items as $item)
				<li @class(['brave-breadcrumb-item', $itemClass]) itemprop="itemListElement" itemtype="https://schema.org/ListItem" itemscope
					{!! $loop->last ? 'aria-current="page"' : '' !!}>
					@if (!empty($item['url']))
						<a @class(['brave-breadcrumb-item-link', $linkClass]) href="{{ $item['url'] }}" itemprop="item" itemtype="https://schema.org/WebPage"
							itemscope>
							<span class="brave-breadcrumb-item-link-span" itemprop="name">{!! $item['label'] !!}</span>
						</a>
					@else
						<span @class(['brave-breadcrumb-item-current', $currentItemClass]) itemprop="name">{{ $item['label'] }}</span>
					@endif
					<meta itemprop="position" content="{{ $loop->iteration }}">
				</li>
			@endforeach
		</ol>
	</nav>
@endif
