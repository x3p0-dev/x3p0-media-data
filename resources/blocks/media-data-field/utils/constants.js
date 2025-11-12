/**
 * Constants.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {__, _x} from "@wordpress/i18n";

/**
 * Media ID context key.
 * @type {string}
 */
export const MEDIA_ID_CONTEXT = 'x3p0-media-data/mediaId';

/**
 * Metadata context key.
 * @type {string}
 */
export const METADATA_CONTEXT = 'x3p0-media-data/metadata';

/**
 * EXIF orientation values and their human-readable labels.
 */
export const EXIF_ORIENTATIONS = {
	1: __('Normal', 'x3p0-media-data'),
	2: __('Mirrored Horizontally', 'x3p0-media-data'),
	3: __('Rotated 180&deg;', 'x3p0-media-data'),
	4: __('Mirrored Vertically', 'x3p0-media-data'),
	5: __('Rotated 90&deg;, Mirrored Horizontally', 'x3p0-media-data'),
	6: __('Rotated 90&deg;', 'x3p0-media-data'),
	7: __('Rotated 270&deg;, Mirrored Horizontally', 'x3p0-media-data'),
	8: __('Rotated 270&deg;', 'x3p0-media-data')
};

/**
 * Byte unit definitions with their magnitudes. Ordered from largest to smallest
 * for efficient conversion.
 */
export const BYTE_UNITS = [
	{
		// Translators: Unit symbol for yottabyte.
		unit: _x('YB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 8
	},
	{
		// Translators: Unit symbol for zettabyte.
		unit: _x('ZB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 7
	},
	{
		// Translators: Unit symbol for exabyte.
		unit: _x('EB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 6
	},
	{
		// Translators: Unit symbol for petabyte.
		unit: _x('PB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 5
	},
	{
		// Translators: Unit symbol for terabyte.
		unit: _x('TB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 4
	},
	{
		// Translators: Unit symbol for gigabyte.
		unit: _x('GB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 3
	},
	{
		// Translators: Unit symbol for megabyte.
		unit: _x('MB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 2
	},
	{
		// Translators: Unit symbol for kilobyte.
		unit: _x('KB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024
	},
	{
		// Translators: Unit symbol for byte.
		unit: _x('B', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1
	}
];
