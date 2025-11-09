/**
 * Block edit.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import MediaDataToolbar from './controls/block/MediaDataToolbar';
import MediaDataContent from './content/MediaDataContent';

/**
 * Renders the block edit component.
 * @param props
 * @returns {JSX.Element}
 */
export default (props) => (
	<>
		<MediaDataToolbar {...props}/>
		<MediaDataContent {...props}/>
	</>
);
