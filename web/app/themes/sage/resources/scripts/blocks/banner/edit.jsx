/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor-style.css';

const TEMPLATE = [
	[
		'core/post-title',
		{
			level: 1,
			lock: {
				remove: true,
				move: true,
			},
		},
	],
	[
		'core/paragraph',
		{
			content: __(
				'Korte tekst van ongeveer 3 regels. Cupidatat amet nostrud non elit amet cupidatat elit sit proident anim duis.',
				'sage'
			),
		},
	],
];

const Edit = () => {
	const blockProps = useBlockProps();

	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: TEMPLATE,
	} );

	return <div { ...innerBlocksProps } />;
};

export default Edit;
