/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import edit from './edit';
import icon from './icon';
import metadata from './block.json';
import './style.css';

registerBlockType( metadata, {
	edit,
	icon,
	save: () => null,
} );
