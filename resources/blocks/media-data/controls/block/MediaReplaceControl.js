/**
 * Breadcrumbs toolbar (block controls) component.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useMediaById } from '../../hooks';

import { __ } from '@wordpress/i18n';
import { MediaReplaceFlow } from '@wordpress/block-editor';
import { MenuItem } from '@wordpress/components';

/**
 * Media replace control for the block toolbar.
 * @param props
 * @returns {JSX.Element}
 */
const MediaReplaceControl = ({ attributes, setAttributes }) => {
	const media = useMediaById(attributes.mediaId);

	const onSelectMedia = (selectedMedia) => {
		if (!selectedMedia?.id) {
			return;
		}
		setAttributes({ mediaId: selectedMedia.id });
	};

	return (
		<MediaReplaceFlow
			mediaId={attributes.mediaId}
			mediaURL={media?.source_url}
			allowedTypes={['image', 'video', 'audio', 'application']}
			accept="*"
			onSelect={onSelectMedia}
			name={__('Replace', 'x3p0-media-data')}
			popoverProps={{ placement: 'bottom-start' }}
		>
			{attributes.mediaId && (
				<MenuItem onClick={() => setAttributes({ mediaId: 0 })}>
					{__('Reset', 'x3p0-media-data')}
				</MenuItem>
			)}
		</MediaReplaceFlow>
	);
}

export default MediaReplaceControl;
