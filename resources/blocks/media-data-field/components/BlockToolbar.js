/**
 * Media data field toolbar (block controls) component.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import MediaReplaceControl from './MediaReplaceControl';
import { BlockControls } from '@wordpress/block-editor';

/**
 * Returns the block toolbar controls.
 * @param props
 * @returns {JSX.Element}
 */
const BlockToolbar = (props) => (
	<BlockControls group="other">
		<MediaReplaceControl {...props}/>
	</BlockControls>
);

export default BlockToolbar;
