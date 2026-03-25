import { registerBlockRestrictions } from '@yardinternet/gutenberg-block-restrictions';

const { innerBlockRestrictions = {}, blockSets = {} } =
	window?.theme?.gutenbergConfig || {};

registerBlockRestrictions( {
	innerBlockRestrictions,
	blockSets,
} );
