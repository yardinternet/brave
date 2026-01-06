@props(['id', 'title'])

<dialog id="{{ $id }}" @class([
	'starting:open:scale-90 starting:open:opacity-0 starting:open:backdrop:bg-black/0 transition-discrete backdrop:transition-discrete !my-auto max-w-2xl scale-90 bg-transparent p-4 opacity-0 transition-all duration-300 backdrop:bg-black/0 backdrop:pointer-events-none backdrop:transition-all backdrop:duration-300 open:scale-100 open:opacity-100 open:backdrop:bg-black/50',
	$attributes->get('class'),
])>
	<div class="rounded-theme bg-white p-4 md:p-5 lg:p-6">
		<div class="mb-3 flex items-center justify-between gap-2">
			<h2 class="mb-0 text-xl">{{ $title }}</h2>
			<button class="js-dialog-close-button hocus:bg-gray-100 size-8 rounded-full text-2xl" aria-label="Sluiten">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		{{ $slot }}
	</div>
</dialog>
