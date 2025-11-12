/**
 * Media data field toolbar (block controls) component.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import MediaReplaceControl from './MediaReplaceControl';
import { useHasBoundMediaId } from '../../../hooks';
import { METADATA_CONTEXT } from '../utils';
import { BlockControls } from '@wordpress/block-editor';

/**
 * Returns the block toolbar controls.
 * @param props
 * @returns {JSX.Element}
 */
const BlockToolbar = (props) => {
	const parentMetadata  = props.context[METADATA_CONTEXT];
	const hasBoundMediaId = useHasBoundMediaId(parentMetadata);

	// Don't allow replacing the media it's already bound.
	if (hasBoundMediaId) {
		return null;
	}

	return (
		<BlockControls group="other">
			<MediaReplaceControl {...props}/>
		</BlockControls>
	);
}

export default BlockToolbar;
