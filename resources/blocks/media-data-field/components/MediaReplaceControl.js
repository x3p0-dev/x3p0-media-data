/**
 * Media replace control.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { MediaReplaceButton } from '../../../components';
import { useBlockPosition }    from '../hooks';

import { store as blockEditorStore } from '@wordpress/block-editor';
import { useDispatch } from '@wordpress/data';

/**
 * Context name for getting media ID from parent block.
 * @type {string}
 */
const MEDIA_ID_CONTEXT = 'x3p0-media-data/mediaId';

/**
 * Returns the inner block media replace control, which allows replacing the
 * media for its parent block.
 * @param props
 * @returns {JSX.Element}
 */
const MediaReplaceControl = (props) => {
	const mediaId = props.context[MEDIA_ID_CONTEXT];

	const { parentClientId }        = useBlockPosition(props.clientId);
	const { updateBlockAttributes } = useDispatch(blockEditorStore);

	return parentClientId && (
		<MediaReplaceButton
			mediaId={mediaId}
			onSelectMedia={(media) => updateBlockAttributes(parentClientId, {
				mediaId: media.id
			})}
			onRemoveMedia={() => updateBlockAttributes(parentClientId, {
				mediaId: 0
			})}
		/>
	);
};

export default MediaReplaceControl;
