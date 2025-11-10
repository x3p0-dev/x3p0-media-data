/**
 * Media replace button component.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useMediaById } from '../hooks';

import { MediaReplaceFlow } from '@wordpress/block-editor';
import { MenuItem } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Toolbar button for replacing a media item.
 * @param mediaId
 * @param onSelectMedia
 * @param onRemoveMedia
 * @returns {JSX.Element}
 */
export const MediaReplaceButton = ({ mediaId, onSelectMedia, onRemoveMedia }) => {
	const media = useMediaById(mediaId);

	const handleSelectMedia = (selectedMedia) => {
		if (! selectedMedia?.id) {
			return;
		}
		onSelectMedia(selectedMedia);
	};

	return (
		<MediaReplaceFlow
			mediaId={mediaId}
			mediaURL={media?.source_url}
			accept="*"
			onSelect={handleSelectMedia}
			name={__('Replace', 'x3p0-media-data')}
			popoverProps={{ placement: 'bottom-start' }}
		>
			{mediaId && (
				<MenuItem onClick={onRemoveMedia}>
					{__('Reset', 'x3p0-media-data')}
				</MenuItem>
			)}
		</MediaReplaceFlow>
	);
};
