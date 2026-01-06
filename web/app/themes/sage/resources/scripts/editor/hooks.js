/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';

/**
 * External dependencies
 */
import { FeaturedImageFocalPointPicker } from '@yardinternet/gutenberg-components';

addFilter( 'yard.fontawesome-family-styles', 'yard', () => [
	{ family: 'classic', style: 'solid' },
	{ family: 'classic', style: 'regular' },
	{ family: 'classic', style: 'light' },
	{ family: 'classic', style: 'thin' },
	{ family: 'classic', style: 'brands' },
	{ family: 'duotone', style: 'solid' },
	{ family: 'sharp', style: 'solid' },
	{ family: 'sharp', style: 'regular' },
	{ family: 'sharp', style: 'light' },
	{ family: 'sharp', style: 'thin' },
] );

addFilter( 'editor.PostFeaturedImage', 'yard', FeaturedImageFocalPointPicker );

addFilter(
	'yard.featured-image-focal-point-picker-allowed-post-types',
	'yard',
	() => [ 'page' ]
);
