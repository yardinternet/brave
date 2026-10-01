/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	BlockControls,
	InnerBlocks,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from '@wordpress/block-editor';
import { getBlockDefaultClassName } from '@wordpress/blocks';
import { Button, PanelBody } from '@wordpress/components';
import { Image, MediaToolbar } from '@yardinternet/gutenberg-components';

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
	const blockClassName = getBlockDefaultClassName(
		blockProps?.[ 'data-type' ] || ''
	);

	const handleImageSelect = ( image ) => {
		setAttributes( { imageId: image.id } );
	};

	const handleImageRemove = () => {
		setAttributes( { imageId: 0 } );
	};

	const handleFocalPointChange = ( value ) => {
		setAttributes( { focalPoint: value } );
	};

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
				<div className={ `${ blockClassName }__body` }>
					<InnerBlocks template={ TEMPLATE } />
				</div>
				{ !! imageId && (
					<Image
						className={ `${ blockClassName }__image` }
						id={ imageId }
						focalPoint={ focalPoint }
						onChangeFocalPoint={ handleFocalPointChange }
						size="large"
						canEditImage={ false }
					/>
				) }
			</div>
			<InspectorControls>
				<PanelBody title={ __( 'Afbeelding', 'sage' ) }>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ handleImageSelect }
							allowedTypes={ [ 'image' ] }
							value={ imageId }
							render={ ( { open } ) => (
								<Button
									onClick={ open }
									variant={ imageId ? 'secondary' : 'primary' }
								>
									{ imageId
										? __( 'Media vervangen', 'sage' )
										: __( 'Media toevoegen', 'sage' ) }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					{ !! imageId && (
						<Button onClick={ handleImageRemove } isDestructive>
							{ __( 'Verwijderen', 'sage' ) }
						</Button>
					) }
				</PanelBody>
			</InspectorControls>
		</>
	);
};

export default Edit;
