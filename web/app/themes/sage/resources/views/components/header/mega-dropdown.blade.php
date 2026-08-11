@props(['item'])

<x-brave::nav.dropdown mode="hover"
	{{ $attributes->class([
	    'ease-base invisible fixed left-1/2 z-10 w-(--container-width) -translate-x-1/2 -translate-y-6 columns-3 gap-x-6 bg-white p-8 opacity-0 shadow-lg transition-all duration-300',
	    'group-has-aria-expanded:visible group-has-aria-expanded:translate-y-0 group-has-aria-expanded:opacity-100',
	]) }}>
	@foreach ($item->children as $child)
		<x-header.dropdown-item :child="$child" class="break-inside-avoid border-b border-gray-100" />
	@endforeach
</x-brave::nav.dropdown>
