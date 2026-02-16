@php
	$listClass = 'flex flex-wrap items-center list-none pl-0 mb-0 gap-x-(--breadcrumbs-list-gap-x) gap-y-(--breadcrumbs-list-gap-y)';

	$itemClass = implode(' ', [
		'flex items-center gap-x-(--breadcrumbs-item-gap-x)',
		'first:before:fontawesome first:before:text-(length:--breadcrumbs-icon-font-size) first:before:content-(--breadcrumbs-home-icon)',
		'not-last:after:fontawesome not-last:after:content-(--breadcrumbs-separator-icon) not-last:after:text-(length:--breadcrumbs-icon-font-size)',
	]);

	$linkClass = 'text-current no-underline hover:text-current hover:underline';
@endphp

@if (!is_front_page())
	<nav class="py-(--breadcrumbs-padding-y) leading-(--breadcrumbs-leading) text-(length:--breadcrumbs-font-size)">
		<ul @class([$listClass])>
			<li @class([$itemClass])>
				<a @class([$linkClass]) href="/">Home</a>
			</li>
			<li @class([$itemClass])>
				<a @class([$linkClass]) href="/projecten">Projecten</a>
			</li>
			<li @class([$itemClass])>
				<span>Pariatur sint sunt velit</span>
			</li>
		</ul>
	</nav>
@endif
