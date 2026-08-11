@props(['item'])

<x-brave::nav.dropdown mode="hover"
	{{ $attributes->class([
	    'ease-base invisible absolute min-w-60 -translate-y-3 bg-white opacity-0 shadow-md transition-all',
	    'group-has-aria-expanded:visible group-has-aria-expanded:translate-y-0 group-has-aria-expanded:opacity-100',
	]) }}>
	@foreach ($item->children as $child)
		<x-header.dropdown-item :child="$child" />
	@endforeach
</x-brave::nav.dropdown>
