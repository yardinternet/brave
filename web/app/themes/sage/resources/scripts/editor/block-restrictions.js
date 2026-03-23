/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';

const blockSets = window?.theme.gutenbergConfig?.blockSets ?? {};
const innerBlockRestrictions =
	window?.theme.gutenbergConfig?.innerBlockRestrictions ?? {};

/**
 * Resolve config for a parent block
 */
const resolveAllowedBlocks = ( rule = {}, defaultAllowedBlocks = [] ) => {
	const base = rule.allowedBlocks ?? blockSets[ rule.blockSet ] ?? [];
	const add = rule.add ?? [];
	const remove = rule.remove ?? [];

	const merged = [ ...defaultAllowedBlocks, ...base, ...add ];

	return [ ...new Set( merged ) ].filter(
		( blockName ) => ! remove.includes( blockName )
	);
};

/**
 * Only allow certain blocks in some blocks. See `innerBlockRestrictions` in `config/gutenberg.php` for configuration.
 */
addFilter(
	'blocks.registerBlockType',
	'yard/restrict-inner-blocks',
	( settings, name ) => {
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
