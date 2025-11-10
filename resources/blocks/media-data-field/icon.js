/**
 * Block icon.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {Path, SVG} from '@wordpress/primitives';

/**
 * Returns the block icon.
 * @returns {JSX.Element}
 * @link    https://fonts.google.com/icons?icon.query=meta&icon.size=24&icon.color=%235f6368&icon.set=Material+Symbols&selected=Material+Symbols+Outlined:page_info:FILL@0;wght@400;GRAD@0;opsz@24
 */
export default () => (
	<SVG xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
		<Path d="M710-150q-63 0-106.5-43.5T560-300q0-63 43.5-106.5T710-450q63 0 106.5 43.5T860-300q0 63-43.5 106.5T710-150Zm0-80q29 0 49.5-20.5T780-300q0-29-20.5-49.5T710-370q-29 0-49.5 20.5T640-300q0 29 20.5 49.5T710-230Zm-550-30v-80h320v80H160Zm90-250q-63 0-106.5-43.5T100-660q0-63 43.5-106.5T250-810q63 0 106.5 43.5T400-660q0 63-43.5 106.5T250-510Zm0-80q29 0 49.5-20.5T320-660q0-29-20.5-49.5T250-730q-29 0-49.5 20.5T180-660q0 29 20.5 49.5T250-590Zm230-30v-80h320v80H480Zm230 320ZM250-660Z"/>
	</SVG>
);
