/**
 * Media placeholder control.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps, MediaPlaceholder } from '@wordpress/block-editor';
import { useDispatch } from "@wordpress/data";
import { store as noticesStore } from "@wordpress/notices";
import { Path, SVG } from "@wordpress/primitives";

/**
 * Icon used for the media placeholder.
 * @type {JSX.Element}
 */
const MEDIA_ICON = (
	<SVG xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
		<Path d="M360-440h400L622-620l-92 120-62-80-108 140ZM120-120q-33 0-56.5-23.5T40-200v-520h80v520h680v80H120Zm160-160q-33 0-56.5-23.5T200-360v-440q0-33 23.5-56.5T280-880h200l80 80h280q33 0 56.5 23.5T920-720v360q0 33-23.5 56.5T840-280H280Zm0-80h560v-360H527l-80-80H280v440Zm0 0v-440 440Z"/>
	</SVG>
);

/**
 * Array of allowed inner blocks.
 * @type {string[]}
 */
const ALLOWED_BLOCKS = ['x3p0/media-data-field'];

/**
 * Inner blocks template.
 * @type array
 */
const TEMPLATE = [
	['x3p0/media-data-field', { field: 'title' }],
	['x3p0/media-data-field', { field: 'file_name' }],
	['x3p0/media-data-field', { field: 'mime_type' }],
	['x3p0/media-data-field', { field: 'file_size' }],
];

/**
 * Media data block content component.
 * @param props
 * @returns {JSX.Element}
 */
const MediaDataContent = (props) => {
	const { attributes, setAttributes } = props;
	const { mediaId } = attributes;

	const blockProps = useBlockProps();

	const innerBlocksProps = useInnerBlocksProps(blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		template: TEMPLATE,
		templateLock: false,
		templateInsertUpdatesSelection: true
	});

	const { createErrorNotice } = useDispatch(noticesStore);

	const onUploadError = (message) => {
		void createErrorNotice(message, {
			type: 'snackbar',
			isDismissible: true
		});
	};

	const onSelectMedia = (selectedMedia) => {
		if (! selectedMedia?.id) {
			return;
		}
		setAttributes({ mediaId: selectedMedia.id });
	};

	// If media is available, return the block container.
	if (mediaId) {
		return (
			<div {...innerBlocksProps} />
		);
	}

	// Show placeholder if no media is available.
	return (
		<div {...blockProps}>
			<MediaPlaceholder
				icon={MEDIA_ICON}
				labels={{
					title: __('Media Data', 'x3p0-media-data'),
					instructions: __(
						'Drag and drop a file, upload, or choose from your library to display its data.',
						'x3p0-media-data'
					)
				}}
				onSelect={onSelectMedia}
				onError={onUploadError}
				accept="*"
				allowedTypes={['image', 'video', 'audio', 'application']}
			/>
		</div>
	);
};

export default MediaDataContent;
