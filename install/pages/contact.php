<?php

declare(strict_types=1);

return [
	[
		'blockName' => 'core/columns',
		'attrs' => [
			'align' => 'wide',
		],
		'innerBlocks' => [
			[
				'blockName' => 'core/column',
				'attrs' => [
					'width' => '66.66%',
				],
				'innerBlocks' => [
					[
						'blockName' => 'core/heading',
						'attrs' => [],
						'innerContent' => [
							"\n<h2 class=\"wp-block-heading\">Contactformulier</h2>\n",
						],
					],
					[
						'blockName' => 'gravityforms/form',
						'attrs' => [
							'formId' => '2',
							'title' => false,
							'inputPrimaryColor' => '#204ce5',
						],
						'innerContent' => [],
					],
				],
				'innerContent' => [
					'<div class="wp-block-column" style="flex-basis:66.66%">',
					null,
					'',
					null,
					'</div>',
				],
			],
			[
				'blockName' => 'core/column',
				'attrs' => [
					'width' => '33.33%',
				],
				'innerBlocks' => [
					[
						'blockName' => 'core/group',
						'attrs' => [
							'backgroundColor' => 'white',
						],
						'innerBlocks' => [
							[
								'blockName' => 'core/heading',
								'attrs' => [],

								'innerContent' => [
									"\n<h2 class=\"wp-block-heading\">Zijbalk</h2>\n",
								],
							],
							[
								'blockName' => 'core/paragraph',
								'attrs' => [],
								'innerContent' => [
									"\n<p>Sed mattis libero sit amet lobortis iaculis. Etiam efficitur odio a est tincidunt sagittis. Curabitur ornare mollis mi non maximus. Fusce lacinia luctus purus. Cras commodo malesuada dui, aliquet sagittis nibh ultricies vel. </p>\n",
								],
							],
						],
						'innerContent' => [
							'<div class="wp-block-group has-white-background-color has-background">',
							null,
							'',
							null,
							'</div>',
						],
					],
				],
				'innerContent' => [
					'<div class="wp-block-column" style="flex-basis:33.33%">',
					null,
					'</div>',
				],
			],
		],
		'innerContent' => [
			'<div class="wp-block-columns alignwide">',
			null,
			'',
			null,
			'</div>',
		],
	],
];
