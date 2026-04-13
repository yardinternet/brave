<div
	{{ $attributes->merge([
	    'class' => 'flex flex-wrap items-center gap-x-2 has-[.facetwp-selections:empty]:hidden',
	]) }}>
	<span class="js-brave-facetwp-filter-label text-sm">Filters:</span>
	{!! facetwp_display('selections') !!}
</div>
