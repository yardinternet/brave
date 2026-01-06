/**
 * WordPress dependencies
 */
import { PageAttributesParent } from '@wordpress/editor';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import './editor-style.css';

const Edit = () => {
	const blockProps = useBlockProps( {
		className: 'wp-block-buttons',
	} );

	return (
		<div { ...blockProps }>
			<div className="wp-block-button is-style-back">
				<button className="wp-block-button__link">Terug</button>
			</div>
			<PageAttributesParent />
		</div>
	);
};

export default Edit;
