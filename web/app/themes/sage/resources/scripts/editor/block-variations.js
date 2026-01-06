/**
 * WordPress dependencies
 */
import {
	registerBlockVariation,
	unregisterBlockVariation,
} from '@wordpress/blocks';

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

	unusedVariations.forEach( ( { block, variation } ) => {
		unregisterBlockVariation( block, variation );
	} );
} );
