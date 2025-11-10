/**
 * Has bound media hook.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {useSelect} from "@wordpress/data";
import {getBlockBindingsSource} from "@wordpress/blocks";

/**
 * Determines whether a block has a binding tied to its `mediaId` attribute.
 * @param metadata
 */
export function useHasBoundMediaId(metadata) {
	return useSelect(
		() => {
			const blockBindingsSource = getBlockBindingsSource(
				metadata?.bindings?.mediaId?.source
			);

			return !! blockBindingsSource;
		},
		[ metadata?.bindings?.mediaId ]
	);
}
