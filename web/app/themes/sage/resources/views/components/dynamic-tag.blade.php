{{-- blade-formatter-disable --}}
<{{ $tag }} {{ $attributes->except('tag') }}>
	{{ $slot }}
</{{ $tag }}>
