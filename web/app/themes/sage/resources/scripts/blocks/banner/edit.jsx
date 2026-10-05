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
import { dispatch } from '@wordpress/data';
import { store as editorStore } from '@wordpress/editor';
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
			placeholder: __(
				'Korte tekst van maximaal 7 regels. Lorem ipsum cupidatat amet nostrud non elit amet cupidatat elit sit proident anim duis.',
				'sage'
			),
		},
	],
];

const Edit = ( props ) => {
	const { attributes, setAttributes } = props;
	const { imageId, focalPoint } = attributes;
	const blockProps = useBlockProps( {
		className: 'alignfull',
	} );
	const blockClassName = getBlockDefaultClassName(
		blockProps?.[ 'data-type' ] || ''
	);

	const handleImageSelect = ( image ) => {
		setAttributes( { imageId: image.id } );
		dispatch( editorStore ).editPost( { featured_media: image.id } );
	};

	const handleImageRemove = () => {
		setAttributes( { imageId: 0 } );
		dispatch( editorStore ).editPost( { featured_media: 0 } );
	};

	const handleFocalPointChange = ( value ) => {
		setAttributes( { focalPoint: value } );
	};

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: `${ blockClassName }__content`,
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
				<div className={ `${ blockClassName }__container` }>
					<div { ...innerBlocksProps } />
					{ !! imageId && (
						<div
							className={ `${ blockClassName }__image-container` }
						>
							<Image
								className={ `${ blockClassName }__image` }
								id={ imageId }
								focalPoint={ focalPoint }
								onChangeFocalPoint={ handleFocalPointChange }
								size="large"
								canEditImage={ false }
							/>
						</div>
					) }
				</div>
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
