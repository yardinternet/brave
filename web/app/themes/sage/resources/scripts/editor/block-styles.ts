/**
 * WordPress dependencies
 */
import { registerBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

const blockStyles = [
	{
		block: 'core/button',
		label: 'Outline',
		name: 'outlined',
	},
	{
		block: 'core/list',
		label: 'Stijlloos',
		name: 'unstyled',
	},
];

domReady( () => {
	// Register block styles
	blockStyles.forEach( ( { block, label, name } ) => {
		registerBlockStyle( block, { name, label } );
	} );
} );
