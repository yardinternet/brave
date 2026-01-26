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

window.addEventListener( 'DOMContentLoaded', () => {
	// Override core/group to start with a background color
	registerBlockVariation( 'core/group', {
		isDefault: true,
		isActive: [ 'className' ],
		name: 'group-with-background',
		attributes: {
			backgroundColor: 'white',
		},
	} );

	// Group: card
	registerBlockVariation( 'core/group', {
		isActive: [ 'className' ],
		name: 'group-card',
		title: 'Kaart',
		description: 'Een kaart met een koptekst en inleiding.',
		attributes: {
			className: 'is-variation-card',
			backgroundColor: 'white',
		},
		icon: {
			src: (
				<svg viewBox="0 0 640 640" xmlns="http://www.w3.org/2000/svg">
					<path d="m518.7 128.3c32.3 3.3 57.5 30.5 57.5 63.7v320l-.3 6.5c-3.1 30.1-27 54.1-57.1 57.1l-6.5.3h-192l-6.5-.3c-12.1-1.2-23.1-5.9-32.3-12.8l70.3-18.8h160.5c17.7 0 32-14.3 32-32v-320c0-17.7-14.3-32-32-32h-75l-8.6-32h83.5zm-221.4-82.9c32-5.2 63.4 14.6 72 46.6l82.8 309.1 1.4 6.4c4.8 29.9-12.1 59.2-40.4 70l-6.2 2-185.4 49.7-6.4 1.3c-29.9 4.8-59.2-12.1-70-40.4l-2.1-6.1-82.8-309.1c-8.6-32 8.7-64.9 39-76.4l6.2-2 185.5-49.7 6.4-1.3zm41.1 54.9c-4.6-17.1-22.1-27.2-39.2-22.6l-185.5 49.7c-17 4.6-27.2 22.1-22.6 39.2l82.8 309.1c4.6 17.1 22.1 27.2 39.2 22.6l185.4-49.7c17.1-4.6 27.2-22.1 22.6-39.2z" />
				</svg>
			),
			foreground: BlockIconColor.foreground,
		},
		scope: [ 'block', 'inserter' ],
		innerBlocks: [
			[ 'core/heading', { placeholder: 'Koptekst h3', level: 3 } ],
			[
				'core/paragraph',
				{
					placeholder:
						'Korte inleiding van maximaal 5 regels. Plaats een link achter de koptekst voor een volledig klikbare kaart.',
				},
			],
		],
	} );

	unusedVariations.forEach( ( { block, variation } ) => {
		unregisterBlockVariation( block, variation );
	} );
} );
