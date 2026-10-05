/**
 * WordPress dependencies
 */
import { store as blocksStore } from '@wordpress/blocks';
import { dispatch, select, subscribe } from '@wordpress/data';
import { addFilter } from '@wordpress/hooks';

/**
 * Internal dependencies
 */
import metadata from './block.json';

/**
 * "Groeperen" Toolbar button uses theme/group now
 */
const unsubscribeGroupingBlock = subscribe( () => {
	if ( select( blocksStore ).getGroupingBlockName() !== 'core/group' ) {
		return;
	}

	unsubscribeGroupingBlock();
	dispatch( blocksStore ).setGroupingBlockName( metadata.name );
}, blocksStore );

/**
 * Remove transform to core/group and core/columns blocks
 */
addFilter( 'blocks.registerBlockType', metadata.name, ( settings, name ) => {
	if ( ! [ 'core/group', 'core/columns' ].includes( name ) ) {
		return settings;
	}

	return {
		...settings,
		transforms: {
			...settings.transforms,
			from: settings.transforms?.from?.filter(
				( transform ) => ! transform.blocks?.includes( '*' )
			),
		},
	};
} );
