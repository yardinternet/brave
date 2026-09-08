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
			content: __( 'Titel van de kaart', 'sage' ),
			level: '3',
		},
	],
	[
		'core/paragraph',
		{
			content: __( 'Korte tekst van ongeveer 3 regels. Cupidatat amet nostrud non elit amet cupidatat elit sit proident anim duis.', 'sage' ),
		},
	],
];

const Edit = () => {
	const blockProps = useBlockProps();

	return (
		<div { ...blockProps }>
			<InnerBlocks template={ TEMPLATE } />
		</div>
	);
};

export default Edit;
