/**
 * WordPress dependencies
 */
import { registerBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

const buttonStyles = [
	{
		label: 'Outline',
		name: 'outlined',
	},
];

const listStyles = [
	{
		label: 'Stijlloos',
		name: 'unstyled',
	},
];

domReady( () => {
	// Register block styles
	registerBlockStyle( 'core/button', buttonStyles );
	registerBlockStyle( 'core/list', listStyles );
} );
