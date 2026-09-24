/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor-style.css';

const TEMPLATE = [
	[
		'core/heading',
		{
			align: 'wide',
			content: __( 'Titel van de sectie', 'sage' ),
			level: 2,
		},
	],
	[
		'core/paragraph',
		{
			align: 'wide',
		},
	],
];

const Edit = () => {
	const innerBlocksProps = useInnerBlocksProps(
		useBlockProps( {
			className: 'alignfull',
		} ),
		{
			template: TEMPLATE,
		}
	);

	return <div { ...innerBlocksProps } />;
};

export default Edit;
