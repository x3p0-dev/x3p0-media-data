/**
 * Media data formatters.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {BYTE_UNITS} from './constants';
import {__, _x, sprintf} from '@wordpress/i18n';

/**
 * Formats an aperture number as an f-stop value.
 * @param {string|number} aperture - Raw aperture value (can be fraction like "28/10")
 * @returns {string} Formatted aperture (e.g., "f/2.8") or empty string
 */
export function formatAperture(aperture) {
	// Return empty string if no aperture data.
	if (!aperture && aperture !== 0) {
		return '';
	}

	// Handle fraction format (e.g., "28/10").
	if (typeof aperture === 'string' && aperture.includes('/')) {
		const parts = aperture.split('/');
		if (parts.length === 2) {
			const numerator = parseFloat(parts[0]);
			const denominator = parseFloat(parts[1]);
			if (!isNaN(numerator) && !isNaN(denominator) && denominator !== 0) {
				aperture = numerator / denominator;
			}
		}
	}

	// Convert to number if it's a numeric string.
	if (typeof aperture === 'string') {
		aperture = parseFloat(aperture);
	}

	// Ensure we have a valid number.
	if (isNaN(aperture) || aperture <= 0) {
		return '';
	}

	// Format the aperture value by removing unnecessary decimal places
	// (e.g., 2.8 instead of 2.80).
	const formatted = aperture.toFixed(2).replace(/\.?0+$/, '');

	return 'f/' + formatted;
}

/**
 * Formats bytes into human-readable file.
 * @param {number} bytes - File size in bytes
 * @param {number} decimals - Number of decimal places
 * @returns {string|boolean} Formatted size string (e.g., "2.5 MB") or false
 */
export function formatFileSize(bytes, decimals = 0) {
	if (bytes === 0) {
		// Translators: Unit symbol for byte.
		return formatNumber(0, decimals) + ' ' + _x('B', 'unit symbol', 'x3p0-media-data');
	}

	for (const { unit, magnitude } of BYTE_UNITS) {
		if (bytes >= magnitude) {
			const value = bytes / magnitude;
			return formatNumber(value, decimals) + ' ' + unit;
		}
	}

	return false;
}

/**
 * Formats a number with specified decimal places using locale-aware formatting.
 * @param {number} value - Number to format
 * @param {number} decimals - Number of decimal places
 * @returns {string} Formatted number
 */
export function formatNumber(value, decimals) {
	return value.toLocaleString(undefined, {
		minimumFractionDigits: decimals,
		maximumFractionDigits: decimals
	});
}

/**
 * Formats shutter speed value with proper fraction notation.
 * @param {string|number} value - Raw shutter speed value
 * @returns {string} Formatted shutter speed (e.g., "1/250 sec" or "2 sec")
 */
export function formatShutterSpeed(value) {
	if (!value) {
		return '';
	}

	const speed = parseFloat(String(value).replace(/<[^>]*>/g, ''));

	if ((1 / speed) > 1) {
		const reciprocal = 1 / speed;
		const isInteger = reciprocal === Math.round(reciprocal);

		const formattedReciprocal = isInteger
			? formatNumber(reciprocal, 0)
			: formatNumber(reciprocal, 1);

		return sprintf(
			// Translators: %s is the shutter speed of a camera.
			__('%s sec', 'x3p0-media-data'),
			`<sup>${formatNumber(1, 0)}</sup>&#8260;<sub>${formattedReciprocal}</sub>`
		);
	}

	return sprintf(__('%s sec', 'x3p0-media-data'), speed);
}
