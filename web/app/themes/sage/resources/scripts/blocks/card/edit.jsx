/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	BlockControls,
	InnerBlocks,
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';
import { Image, MediaToolbar } from '@yardinternet/gutenberg-components';
import { PanelBody, PanelRow } from '@wordpress/components';

/**
 * Internal dependencies
 */
import './editor-style.css';

const TEMPLATE = [
	[
		'core/heading',
		{
			content: __( 'Titel van de kaart', 'sage' ),
			level: 3,
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

	function handleImageSelect( image ) {
		setAttributes( { imageId: image.id } );
	}

	function handleImageRemove() {
		setAttributes( { imageId: 0 } );
	}

	function handleFocalPointChange( value ) {
		setAttributes( { focalPoint: value } );
	}

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
				<div>
					<InnerBlocks template={ TEMPLATE } />
				</div>
				{ !! imageId && (
					<Image
						id={ imageId }
						focalPoint={ focalPoint }
						size="large"
						canEditImage={ false }
					/>
				) }
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
