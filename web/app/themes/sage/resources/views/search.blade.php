<x-layout>
	<h1 class="wp-block-heading alignwide">Zoekresultaten</h1>

	<div class="facetwp alignwide">
		@include('blocks.FacetWP.templates.default', [
			'template' => [
				'name' => 'search',
			],
			'facets' => [
				[
					'label' => 'Zoeken',
					'name' => 'zoeken',
				],
				[
					'label' => 'Filter op',
					'name' => 'filter_op',
				],
			],
		])
	</div>
</x-layout>
