import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	MediaPlaceholder,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { useDispatch, useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { store as noticesStore } from '@wordpress/notices';
import { createBlock } from '@wordpress/blocks';
import Toolbar from './toolbar';

const mediaIcon = (
	<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M360-440h400L622-620l-92 120-62-80-108 140ZM120-120q-33 0-56.5-23.5T40-200v-520h80v520h680v80H120Zm160-160q-33 0-56.5-23.5T200-360v-440q0-33 23.5-56.5T280-880h200l80 80h280q33 0 56.5 23.5T920-720v360q0 33-23.5 56.5T840-280H280Zm0-80h560v-360H527l-80-80H280v440Zm0 0v-440 440Z"/></svg>
);

const TEMPLATE = [
	['x3p0/media-data-field', { field: 'title' }],
	['x3p0/media-data-field', { field: 'file_name' }],
	['x3p0/media-data-field', { field: 'mime_type' }],
	['x3p0/media-data-field', { field: 'file_size' }],
];

export default (props) => {
	const { attributes, setAttributes, context, clientId } = props;
	const { mediaId } = attributes;
	const { postId, postType } = context;

	// Determine the effective media ID
	const effectiveMediaId = mediaId
		|| (postType === 'attachment' && postId ? postId : 0);

	// Fetch media details
	const media = useSelect(
		(select) => {
			if (!effectiveMediaId) {
				return null;
			}
			return select(coreStore).getEntityRecord('postType', 'attachment', effectiveMediaId);
		},
		[effectiveMediaId]
	);

	const { createErrorNotice } = useDispatch(noticesStore);
	const { insertBlock } = useDispatch(blockEditorStore);

	const blockProps = useBlockProps();

	const innerBlocksProps = useInnerBlocksProps(
		blockProps,
		{
			allowedBlocks: ['x3p0/media-data-field'],
			template: TEMPLATE,
			templateLock: false,
			templateInsertUpdatesSelection: true
		}
	);

	// Shared handlers
	const onUploadError = (message) => {
		void createErrorNotice(message, {
			type: 'snackbar',
			isDismissible: true
		});
	};

	const onSelectMedia = (selectedMedia) => {
		if (!selectedMedia?.id) {
			return;
		}
		setAttributes({ mediaId: selectedMedia.id });
	};

	const onRemoveMedia = () => setAttributes({ mediaId: 0 });

	const addFieldBlock = () => {
		void insertBlock(createBlock('x3p0/media-data-field', {}), undefined, clientId);
	};

	// Show placeholder if no media is available
	if (!effectiveMediaId) {
		return (
			<div {...blockProps}>
				<MediaPlaceholder
					icon={mediaIcon}
					labels={{
						title: __('Media Data', 'x3p0-media-data'),
						instructions: __(
							'Drag and drop a file, upload, or choose from your library to display its data.',
							'x3p0-media-data'
						),
					}}
					onSelect={onSelectMedia}
					onError={onUploadError}
					accept="*"
					allowedTypes={['image', 'video', 'audio', 'application']}
				/>
			</div>
		);
	}

	return (
		<>
			<Toolbar
				{...props}
				mediaUrl={media?.source_url}
				effectiveMediaId={effectiveMediaId}
				onSelectMedia={onSelectMedia}
				onRemoveMedia={onRemoveMedia}
				onAddFieldBlock={addFieldBlock}
			/>
			<div {...innerBlocksProps} />
		</>
	);
};
