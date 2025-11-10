/**
 * Block position hook.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useSelect } from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';

/**
 * Finds the block position and gets its parent ID.
 * @param clientId
 * @returns {UseSelectReturn<function(*): {parentClientId: *, blockIndex: *}>}
 */
export function useBlockPosition(clientId) {
	return useSelect(
		(select) => {
			const { getBlockParents, getBlockIndex } = select(blockEditorStore);
			const parents = getBlockParents(clientId);

			return {
				parentClientId: parents[parents.length - 1],
				blockIndex: getBlockIndex(clientId),
			};
		},
		[clientId]
	);
}
