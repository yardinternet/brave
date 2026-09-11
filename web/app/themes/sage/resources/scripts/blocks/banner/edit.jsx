/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	BlockControls,
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import { getBlockDefaultClassName } from '@wordpress/blocks';
import { PanelBody, PanelRow } from '@wordpress/components';
import { Image, MediaToolbar } from '@yardinternet/gutenberg-components';

/**
 * Internal dependencies
 */
import './editor-style.css';

const TEMPLATE = [
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
				'Korte tekst van ongeveer 3 regels. Cupidatat amet nostrud non elit amet cupidatat elit sit proident anim duis.',
				'sage'
			),
		},
	],
];

const Edit = ( props ) => {
	const { attributes, setAttributes } = props;
	const { imageId, focalPoint } = attributes;
	const blockProps = useBlockProps();
	const blockDefaultClassName = getBlockDefaultClassName(
		blockProps?.[ 'data-type' ] || ''
	);

	function handleImageSelect( image ) {
		setAttributes( { imageId: image.id } );
	}

	function handleImageRemove() {
		setAttributes( { imageId: 0 } );
	}

	function handleFocalPointChange( value ) {
		setAttributes( { focalPoint: value } );
	}

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: `${ blockDefaultClassName }__content`,
		},
		{ template: TEMPLATE }
	);

	return (
		<>
			<BlockControls>
				<MediaToolbar
					isOptional
					id={ imageId }
					onSelect={ handleImageSelect }
					onRemove={ handleImageRemove }
				/>
			</BlockControls>
			<div { ...blockProps }>
				<div className={ `${ blockDefaultClassName }__inner` }>
					<div { ...innerBlocksProps } />
					{ !! imageId && (
						<div className={ `${ blockDefaultClassName }__media` }>
							<Image
								className={ `${ blockDefaultClassName }__image` }
								id={ imageId }
								focalPoint={ focalPoint }
								size="large"
								canEditImage={ false }
							/>
						</div>
					) }
				</div>
			</div>
			<InspectorControls>
				<PanelBody title={ __( 'Afbeelding', 'sage' ) }>
					<PanelRow>
						<Image
							id={ imageId }
							className="my-image"
							size="full"
							onSelect={ handleImageSelect }
							focalPoint={ focalPoint }
							onChangeFocalPoint={ handleFocalPointChange }
							labels={ {
								title: 'Selecteer je afbeelding',
								instructions:
									'Upload een afbeelding of kies er één uit de mediabibliotheek.',
							} }
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		</>
	);
};

export default Edit;
