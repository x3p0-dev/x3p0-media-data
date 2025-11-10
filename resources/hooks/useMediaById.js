/**
 * Use media by ID hook.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';

/**
 * Custom hook to fetch media/attachment by ID.
 *
 * @param {number|null} mediaId - The attachment ID to fetch
 * @returns {Object|null} The media entity record or null
 */
export function useMediaById(mediaId) {
	return useSelect(
		(select) => {
			if (!mediaId) {
				return null;
			}
			return select(coreStore).getEntityRecord('postType', 'attachment', mediaId);
		},
		[mediaId]
	);
}
