
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';

/**
 * Custom hook to fetch media/attachment by ID
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
