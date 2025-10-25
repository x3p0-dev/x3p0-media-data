import {__, _x, sprintf} from '@wordpress/i18n';
import { dateI18n } from '@wordpress/date';
import {useBlockProps, InspectorControls, RichText, useInnerBlocksProps, BlockControls, MediaReplaceFlow} from '@wordpress/block-editor';
import {PanelBody, SelectControl, Notice, MenuItem, TextControl} from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { store as blocksStore } from '@wordpress/blocks';
import { RawHTML, useEffect } from '@wordpress/element';
import { createBlock } from '@wordpress/blocks';

import { getMediaField } from '../media-data';

export default function Edit({ attributes, setAttributes, context, clientId, isSelected }) {
	const { field, label } = attributes;
	const mediaId = context['x3p0/mediaId'];

	const { updateBlockAttributes, insertBlock, selectBlock } = useDispatch(blockEditorStore);

	// Get the parent block's client ID
	const { parentClientId, blockIndex } = useSelect(
		(select) => {
			const { getBlockParents, getBlockIndex } = select(blockEditorStore);
			const parents = getBlockParents(clientId);
			return {
				parentClientId: parents[parents.length - 1],
				blockIndex: getBlockIndex(clientId),
			};
		},
		[clientId]
	);

	const fieldOptions = useSelect((select) => {
		const variations = select(blocksStore).getBlockVariations('x3p0/media-data-field');

		if (! variations) {
			return [];
		}

		// sorted alphabetically.
		return variations.map(item => ({
			value: item.attributes.field,
			label: item.title
		})).sort((a, b) => a.label.localeCompare(b.label));
	}, []);

	// Fetch the metadata value from the REST API using new API
	const { media, fieldValue, isResolving } = useSelect(
		(select) => {
			if (!mediaId) {
				return { fieldValue: null, isResolving: false };
			}

			const media = select(coreStore).getEntityRecord(
				'postType',
				'attachment',
				mediaId
			);

			return {
				media,
				fieldValue: getMediaField(media, field),
				isResolving: ! select(coreStore).hasFinishedResolution(
					'getEntityRecord',
					['postType', 'attachment', mediaId]
				)
			};
		},
		[mediaId, field]
	);

	// Handle keyboard events when block is selected
	useEffect(() => {
		if (! isSelected) {
			return;
		}

		const handleKeyDown = (event) => {
			// Check if Enter key is pressed (and not inside RichText)
			if (event.key === 'Enter' && ! event.target.closest('.wp-block-x3p0-media-data-field__label')) {
				event.preventDefault();

				// Create a new field block with default attributes
				const newBlock = createBlock('x3p0/media-data-field');

				// Insert the new block after the current block
				insertBlock(newBlock, blockIndex + 1, parentClientId);

				// Select the new block
				selectBlock(newBlock.clientId);
			}
		};

		document.addEventListener('keydown', handleKeyDown);

		return () => {
			document.removeEventListener('keydown', handleKeyDown);
		};
	}, [isSelected, blockIndex, parentClientId, insertBlock, selectBlock]);

	const blockProps = useBlockProps({
		className: `wp-block-x3p0-media-data-field--${
			field ? field.replace(/_/g, "-") : 'title'
		}`
	});

	// We must use inner block props for layout styles to work properly in
	// the admin, even though this block doesn't have nested blocks.
	const innerBlocksProps = useInnerBlocksProps(blockProps);

	const onSelectMedia = (selectedMedia) => {
		if (parentClientId) {
			updateBlockAttributes(parentClientId, { mediaId: selectedMedia.id });
		}
	};

	const onRemoveMedia = () => {
		if (parentClientId) {
			updateBlockAttributes(parentClientId, { mediaId: 0 });
		}
	};

	// Show notice if no media ID in context
	if (! mediaId) {
		return (
			<div {...blockProps}>
				<Notice status="warning" isDismissible={false}>
					{__('No connected media ID.', 'x3p0-media-data')}
				</Notice>
			</div>
		);
	}

	const currentField = fieldOptions.find(option => option.value === field);
	const displayLabel = currentField?.label || __('Data', 'x3p0-media-data');

	return (
		<>
			<BlockControls group="other">
				<MediaReplaceFlow
					mediaId={mediaId}
					mediaURL={media?.source_url}
					accept="*"
					onSelect={onSelectMedia}
					name={__('Replace', 'x3p0-media-data')}
					popoverProps={{ placement: 'bottom-start' }}
				>
					<MenuItem onClick={onRemoveMedia}>
						{__('Reset', 'x3p0-media-data')}
					</MenuItem>
				</MediaReplaceFlow>
			</BlockControls>

			<InspectorControls>
				<PanelBody title={__('Field Settings', 'x3p0-media-data')}>
					<SelectControl
						label={__('Field', 'x3p0-media-data')}
						value={field}
						options={fieldOptions}
						onChange={(value) => setAttributes({ field: value })}
						__nextHasNoMarginBottom
						__next40pxDefaultSize
					/>
					<TextControl
						__next40pxDefaultSize
						__nextHasNoMarginBottom
						label={__('Label', 'x3p0-media-data')}
						placeholder={displayLabel}
						value={label}
						onChange={(value) => setAttributes({ label: value })}
					/>
					{! isResolving && ! fieldValue && (
						<Notice status="warning" isDismissible={false}>
							{__('No data was found for the selected media field.', 'x3p0-media-data')}
						</Notice>
					)}
				</PanelBody>
			</InspectorControls>

			<div {...innerBlocksProps}>
				<RichText
					tagName="div"
					className="wp-block-x3p0-media-data-field__label"
					value={label}
					onChange={(value) => setAttributes({ label: value })}
					placeholder={displayLabel}
				/>
				<div className="wp-block-x3p0-media-data-field__content">
					{isResolving && (
						<span className="wp-block-x3p0-media-data-field__loading">
							{__('Loading…', 'x3p0-media-data')}
						</span>
					)}
					{! isResolving && fieldValue && (
						<RawHTML>{fieldValue}</RawHTML>
					)}
					{! isResolving && ! fieldValue && (
						<span className="wp-block-x3p0-media-data-field__empty">
							{__('No data', 'x3p0-media-data')}
						</span>
					)}
				</div>
			</div>
		</>
	);
}
