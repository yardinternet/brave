<div @class([
	'border-l-4 p-4 my-6 flex items-center gap-3',
	$alertClasses(),
	$attributes->get('class'),
])>
	<i @class(['text-2xl', $alertIcon()])></i>
	<div>
		{{ $slot }}
	</div>
</div>
