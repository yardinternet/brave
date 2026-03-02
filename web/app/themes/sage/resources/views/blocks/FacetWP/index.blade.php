@php
	$align = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
	$name = is_array($template) && isset($template['name']) ? str_replace('_', '-', $template['name']) : null;
@endphp

<div @class(['facetwp', $align])>
	@if (!function_exists('facetwp_display'))
		<x-alert type="danger">
			De plugin FacetWP is niet geïnstalleerd of geactiveerd.
		</x-alert>
	@elseif ($template === false)
		<x-alert type="danger">
			Het geselecteerde FacetWP-template bestaat niet.
		</x-alert>
	@elseif (!$name || !View::exists('blocks.FacetWP.templates.' . $name))
		<x-alert type="danger">
			De view <code>{{ $name }}</code> bestaat niet in <code>/views/blocks/FacetWP/templates/*</code>
		</x-alert>
	@else
		@include('blocks.FacetWP.templates.' . $name)
	@endif
</div>
