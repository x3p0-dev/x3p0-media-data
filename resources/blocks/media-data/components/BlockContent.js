/**
 * Block content component.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import MediaPlaceholderControl from './MediaPlaceholderControl';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * Inner blocks template.
 * @type {array}
 */
const TEMPLATE = [
	['x3p0/media-data-field', { field: 'title' }],
	['x3p0/media-data-field', { field: 'file_name' }],
	['x3p0/media-data-field', { field: 'mime_type' }],
	['x3p0/media-data-field', { field: 'file_size' }],
];

/**
 * Media data block content component.
 * @param props {object}
 * @returns {JSX.Element}
 */
const BlockContent = (props) => {
	const { attributes } = props;

	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(blockProps, {
		template: TEMPLATE,
		templateLock: false,
		templateInsertUpdatesSelection: true
	});

	// If media is available, return the block container. Otherwise, display
	// a placeholder.
	return attributes.mediaId ? (
		<div {...innerBlocksProps}/>
	) : (
		<div {...blockProps}>
			<MediaPlaceholderControl {...props}/>
		</div>
	);
};

export default BlockContent;
