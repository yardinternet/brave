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

domReady( () => {
	// Register block styles
	buttonStyles.forEach( ( style ) =>
		registerBlockStyle( 'core/button', style )
	);
} );
