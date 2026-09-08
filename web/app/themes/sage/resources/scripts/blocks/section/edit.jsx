/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

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
	const blockProps = useBlockProps( {
		className: 'alignfull',
	} );

	return (
		<div { ...blockProps }>
			<InnerBlocks template={ TEMPLATE } />
		</div>
	);
};

export default Edit;
