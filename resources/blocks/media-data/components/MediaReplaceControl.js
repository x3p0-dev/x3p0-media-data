/**
 * Media data toolbar (block controls) component.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { MediaReplaceButton } from '../../../components';

/**
 * Media replace control for the block toolbar.
 * @param props
 * @returns {JSX.Element}
 */
const MediaReplaceControl = ({ attributes, setAttributes }) => (
	<MediaReplaceButton
		mediaId={attributes.mediaId}
		onSelectMedia={(media) => setAttributes({ mediaId: media.id })}
		onRemoveMedia={() => setAttributes({ mediaId: 0 })}
	/>
);

export default MediaReplaceControl;
