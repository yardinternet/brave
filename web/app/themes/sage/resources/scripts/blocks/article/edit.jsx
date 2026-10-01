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
		'theme/back-button',
		{
			align: 'none',
			lock: {
				remove: true,
				move: true,
			},
		},
	],
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
				'Schrijf een korte introductie in één lopende alinea. Begin direct met de belangrijkste informatie. Gebruik actieve, duidelijke B1-taal en vermijd overbodige woorden, herhaling en vaag taalgebruik.',
				'sage'
			),
		},
	],
];

const Edit = () => {
	const innerBlocksProps = useInnerBlocksProps( useBlockProps(), {
		template: TEMPLATE,
	} );

	return <div { ...innerBlocksProps } />;
};

export default Edit;
