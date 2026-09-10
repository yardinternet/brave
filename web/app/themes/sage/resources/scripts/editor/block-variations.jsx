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
];

const variationRegistry = [
	// Override core/group to start with a background color
	{
		block: 'core/group',
		postTypes: 'all',
		settings: {
			isDefault: true,
			isActive: [ 'className' ],
			name: 'group-with-background',
			attributes: {
				backgroundColor: 'white',
			},
		},
	},
	// Group: layout article
	{
		block: 'core/group',
		postTypes: [ 'page' ],
		settings: {
			name: 'wp-block-group-layout-article',
			title: 'Layout: artikel',
			description: 'Een layout met witte achtergrond en vaste breedte.',
			attributes: {
				className: 'layout-article',
				tagName: 'article',
			},
			isActive: [ 'className' ],
			icon: {
				src: (
					<svg
						viewBox="0 0 640 640"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path d="m192 96h128v96c0 35.3 28.7 64 64 64h96v256c0 17.7-14.3 32-32 32h-256c-17.7 0-32-14.3-32-32v-384c0-17.7 14.3-32 32-32zm160 13.3 114.7 114.7h-82.7c-17.7 0-32-14.3-32-32zm-160-45.3c-35.3 0-64 28.7-64 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64v-261.5c0-17-6.7-33.3-18.7-45.3l-122.6-122.5c-12-12-28.2-18.7-45.2-18.7zm48 256c-8.8 0-16 7.2-16 16s7.2 16 16 16h160c8.8 0 16-7.2 16-16s-7.2-16-16-16zm0 96c-8.8 0-16 7.2-16 16s7.2 16 16 16h160c8.8 0 16-7.2 16-16s-7.2-16-16-16z" />
					</svg>
				),
				foreground: BlockIconColor.foreground,
			},
			scope: [ 'block', 'inserter' ],
			innerBlocks: [
				[
					'theme/back-button',
					{ align: '', lock: { move: true, remove: true } },
				],
				[ 'core/post-title', { level: 1 } ],
				[ 'core/paragraph', { placeholder: 'Voeg de inhoud toe' } ],
			],
		},
	},
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
