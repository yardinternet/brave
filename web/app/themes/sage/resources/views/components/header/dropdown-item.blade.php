@props(['child'])

<x-brave::nav.item>
	<x-brave::nav.link :item="$child"
		{{ $attributes->class([
		    'group/dropdown-link flex items-center justify-between gap-6 px-6 py-4 text-left leading-snug text-inherit no-underline',
		]) }}
		activeClass="text-primary">
		{!! $child->label !!}
		<i class="fa-light fa-angle-right transition-all group-hover/dropdown-link:translate-x-1"></i>
	</x-brave::nav.link>
</x-brave::nav.item>
