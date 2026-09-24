/**
 * WordPress dependencies
 */
import {
	registerBlockVariation,
	unregisterBlockVariation,
} from '@wordpress/blocks';

/**
 * External dependencies
 */
import { BlockIconColor } from '@yardinternet/gutenberg-components';

const unusedVariations = [
	{
		block: 'core/group',
		variation: 'group',
	},
	{
		block: 'core/group',
		variation: 'group-row',
	},
	{
		block: 'core/group',
		variation: 'group-grid',
	},
];

const variationRegistry = [
	// Columns: article aside layout variation
	{
		block: 'core/columns',
		postTypes: [ 'page' ],
		settings: {
			name: 'wp-block-columns-layout-article-aside',
			title: 'Layout: artikel met zijbalk',
			description: 'Een layout met een hoofdartikel en een zijbalk.',
			attributes: {
				align: 'wide',
				className: 'layout-article-aside',
				verticalAlignment: 'top',
			},
			scope: [ 'block', 'inserter' ],
			icon: {
				src: (
					<svg xmlns="http://www.w3.org/2000/svg">
						<path
							fillRule="evenodd"
							d="M15 7.5h-5v10h5v-10Zm1.5 0v10H19a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5h-2.5ZM6 7.5h2.5v10H6a.5.5 0 0 1-.5-.5V8a.5.5 0 0 1 .5-.5ZM6 6h13a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2Z"
							clipRule="evenodd"
						/>
					</svg>
				),
				foreground: BlockIconColor.foreground,
			},
			isActive: [ 'className' ],
			innerBlocks: [
				[
					'core/column',
					{
						width: '66.66%',
						lock: { move: true, remove: true },
						className: 'layout-article-aside__article',
					},
					[
						[
							'theme/back-button',
							{ align: '', lock: { move: true, remove: true } },
						],
						[ 'core/post-title', { level: 1 } ],
						[
							'core/paragraph',
							{ placeholder: 'Voeg de inhoud toe' },
						],
					],
				],
				[
					'core/column',
					{
						width: '33.33%',
						lock: { move: true, remove: true },
						className: 'layout-article-aside__aside',
						layout: { type: 'default' },
					},
					[
						[
							'core/group',
							{
								backgroundColor: 'white',
								style: {
									spacing: {
										margin: {
											top: '0',
											bottom: '0',
										},
									},
								},
							},
							[
								[
									'core/heading',
									{ level: 2, content: 'Zie ook' },
								],
								[
									'core/paragraph',
									{ placeholder: 'Voeg de inhoud toe' },
								],
							],
						],
					],
				],
			],
			supports: {
				multiple: false,
			},
		},
	},
];

/**
 * Register block variations
 */
window.addEventListener( 'DOMContentLoaded', () => {
	const currentPostType = window.theme?.currentPostType ?? null;

	variationRegistry
		.filter( ( { postTypes } ) =>
			canRegisterForPostType( postTypes, currentPostType )
		)
		.forEach( ( { block, settings } ) => {
			registerBlockVariation( block, settings );
		} );

	unusedVariations.forEach( ( { block, variation } ) => {
		unregisterBlockVariation( block, variation );
	} );
} );

const canRegisterForPostType = ( postTypes, currentPostType ) =>
	postTypes === 'all' ||
	( Array.isArray( postTypes ) && postTypes.includes( currentPostType ) );
