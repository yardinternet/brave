/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';

/**
 * Only allow certain blocks in some blocks. See `innerBlockRestrictions` in `config/gutenberg.php` for configuration.
 */
addFilter(
	'blocks.registerBlockType',
	'yard/restrict-inner-blocks',
	( settings, name ) => {
		const innerBlockRestrictions =
			window?.theme?.gutenbergConfig?.innerBlockRestrictions ?? {};

		const restriction = innerBlockRestrictions?.[ name ];

		if ( ! restriction ) {
			return settings;
		}

		return {
			...settings,
			allowedBlocks: resolveAllowedBlocks(
				restriction,
				settings.allowedBlocks ?? []
			),
		};
	}
);

/**
 * Resolve config for a parent block
 */
const resolveAllowedBlocks = ( rule = {}, defaultAllowedBlocks = [] ) => {
	const blockSets = window?.theme?.gutenbergConfig?.blockSets ?? {};
	const base = blockSets[ rule.blockSet ] ?? [];
	const add = rule.add ?? [];
	const remove = rule.remove ?? [];

	const merged = [ ...defaultAllowedBlocks, ...base, ...add ];

	return [ ...new Set( merged ) ].filter(
		( blockName ) => ! remove.includes( blockName )
	);
};
