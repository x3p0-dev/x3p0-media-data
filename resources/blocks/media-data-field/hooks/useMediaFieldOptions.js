/**
 * Media field options hook.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useSelect } from '@wordpress/data';
import { store as blocksStore } from '@wordpress/blocks';

/**
 * Block type to retrieve variations for.
 * @type {string}
 */
const BLOCK_TYPE = 'x3p0/media-data-field';

/**
 * Gets block variations to use as field options.
 * @returns {array}
 */
export function useMediaFieldOptions() {
	return useSelect((select) => {
		const variations = select(blocksStore).getBlockVariations(BLOCK_TYPE);

		if (! variations) {
			return [];
		}

		return variations.map((item) => ({
			value: item.attributes.field,
			label: item.title,
		})).sort((a, b) => a.label.localeCompare(b.label));
	}, []);
}
