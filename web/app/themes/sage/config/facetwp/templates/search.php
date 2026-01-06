<?php

declare(strict_types=1);

return [
	'name' => 'search',
	'label' => 'Zoeken',
	'query' => '',
	'template' => "<?php echo view('blocks.FacetWP.loops.search-loop'); ?>",
	'layout' => [],
	'query_obj' => [
		'post_type' => [
			[
				'label' => 'Pagina\'s',
				'value' => 'page',
			],
		],
		'posts_per_page' => 7,
		'orderby' => [
		],
		'filters' => [
		],
	],
	'modes' => [
		'display' => 'advanced',
		'query' => 'visual',
	],
];
