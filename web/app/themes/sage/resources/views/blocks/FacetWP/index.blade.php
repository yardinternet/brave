@if (!$template)
	<x-alert>
		Er is geen FacetWP template geselecteerd.
	</x-alert>
@else
	@php
		$customTemplate = str_replace('_', '-', $template['name']);
		$align = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
	@endphp

	<div class="facetwp {{ $align }}">
		@if (!empty($customTemplate) && View::exists('blocks.FacetWP.templates.' . $customTemplate))
			@include('blocks.FacetWP.templates.' . $customTemplate)
		@else
			<x-alert>
				Het geselecteerde FacetWP template <code>{{ $template['name'] }}</code> kan niet gevonden worden.
			</x-alert>
		@endif
	</div>
@endif
