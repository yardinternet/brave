/**
 * WordPress dependencies
 */
import { registerBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

const blockStyles = {
	'core/button': [
		{
			name: 'outlined',
			label: 'Outline',
		},
	],
	'core/list': [
		{
			name: 'unstyled',
			label: 'Stijlloos',
		},
	],
};

domReady( () => {
	Object.entries( blockStyles ).forEach( ( [ block, styles ] ) => {
		styles.forEach( ( style ) => {
			registerBlockStyle( block, style );
		} );
	} );
} );
