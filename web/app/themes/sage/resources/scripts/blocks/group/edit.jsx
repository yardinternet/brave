/**
 * WordPress dependencies
 */
import {
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor-style.css';

const Edit = () => {
	const innerBlocksProps = useInnerBlocksProps( useBlockProps() );

	return <div { ...innerBlocksProps } />;
};

export default Edit;
