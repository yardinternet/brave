/**
 * WordPress dependencies
 */
import { cloneBlock, createBlock } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import metadata from './block.json';

const transforms = {
	from: [
		{
			type: 'block',
			isMultiBlock: true,
			blocks: [ '*' ],
			__experimentalConvert: ( blocks ) =>
				createBlock(
					metadata.name,
					{ backgroundColor: 'primary-100' },
					blocks.map( ( block ) => cloneBlock( block ) )
				),
		},
	],
};

export default transforms;
