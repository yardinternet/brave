<div @class([
	'border-l-4 p-4 flex items-center gap-3 leading-snug',
	$alertClasses(),
	$attributes->get('class'),
])>
	<i @class(['text-2xl', $alertIcon()])></i>
	<div>
		{{ $slot }}
	</div>
</div>
