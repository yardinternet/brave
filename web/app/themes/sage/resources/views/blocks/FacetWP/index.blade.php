@if (!$template)
	<h2>Er is geen template geselecteerd</h2>
@else
	@php
		$customTemplate = str_replace('_', '-', $template['name']);
		$align = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
	@endphp

	<div class="facetwp {{ $align }}">
		@if (!empty($customTemplate) && View::exists('blocks.FacetWP.templates.' . $customTemplate))
			@include('blocks.FacetWP.templates.' . $customTemplate)
		@else
			<h2>Template kan niet gevonden worden.</h2>
		@endif
	</div>
@endif
