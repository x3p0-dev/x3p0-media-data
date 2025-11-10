/**
 * Media field hook.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { getMediaField } from '../utils';

import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';

/**
 * Gets the media field value based on the media ID.
 * @param mediaId
 * @param field
 * @returns {UseSelectReturn<(function(*): ({media: null, fieldValue: null, isResolving: boolean}))|*>}
 */
export function useMediaField(mediaId, field) {
	return useSelect(
		(select) => {
			if (! mediaId) {
				return { media: null, fieldValue: null, isResolving: false };
			}

			// WordPress caches this - no refetch even if called in multiple components
			const media = select(coreStore).getEntityRecord('postType', 'attachment', mediaId);

			return {
				media,
				fieldValue: getMediaField(media, field),
				isResolving: ! select(coreStore).hasFinishedResolution('getEntityRecord', [
					'postType',
					'attachment',
					mediaId,
				]),
			};
		},
		[mediaId, field]
	);
}
