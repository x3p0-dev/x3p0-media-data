/**
 * Media Metadata Utility Module
 *
 * Provides functions for extracting and formatting media metadata from
 * WordPress media objects.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

// Main API
export {getMediaField} from './extractors';

// Constants
export {MEDIA_ID_CONTEXT, METADATA_CONTEXT, EXIF_ORIENTATIONS, BYTE_UNITS} from './constants';
export {VARIATION_ICONS} from './variation-icons';

// Formatters
export {
	formatAperture,
	formatFileSize,
	formatNumber,
	formatShutterSpeed
} from './formatters';

// Helpers
export {
	calculateGCD,
	calculateAspectRatio,
	getNestedProperty
} from './helpers';
