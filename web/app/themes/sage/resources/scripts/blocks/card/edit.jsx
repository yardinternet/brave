/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	BlockControls,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
	useInnerBlocksProps,
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
			placeholder: __( 'Koptekst h3', 'sage' ),
			level: 3,
		},
	],
	[
		'core/paragraph',
		{
			placeholder: __(
				'Korte inleiding van maximaal 5 regels. Plaats een link achter de koptekst voor een volledig klikbare kaart.',
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

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: `${ blockClassName }__body`,
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
				<div { ...innerBlocksProps } />
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
									variant={
										imageId ? 'secondary' : 'primary'
									}
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
