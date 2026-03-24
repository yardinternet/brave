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
	buttonStyles.forEach( ( style ) =>
		registerBlockStyle( 'core/button', style )
	);

	listStyles.forEach( ( style ) => registerBlockStyle( 'core/list', style ) );
} );
