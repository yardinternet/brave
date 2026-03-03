<x-layout>
	<h1 class="wp-block-heading alignwide">Zoekresultaten</h1>

	@include('blocks.FacetWP.index', [
		'attributes' => [
			'align' => 'wide',
		],
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
</x-layout>
