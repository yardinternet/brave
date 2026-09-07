/**
 * WordPress dependencies
 */
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor-style.css';

const Edit = () => {
	const blockProps = useBlockProps({
		className: 'alignfull',
	});

	return (
		<div { ...blockProps }>
			<InnerBlocks />
		</div>
	);
};

export default Edit;
