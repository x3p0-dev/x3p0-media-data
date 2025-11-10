/**
 * Helper utilities.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

/**
 * Calculates the greatest common divisor of two numbers using Euclidean algorithm.
 * @param {number} a - First number
 * @param {number} b - Second number
 * @returns {number} The GCD
 */
export function calculateGCD(a, b) {
	return b === 0 ? a : calculateGCD(b, a % b);
}

/**
 * Calculates the aspect ratio from width and height.
 * @param   {number} width - Image width
 * @param   {number} height - Image height
 * @returns {string} Aspect ratio in format "width:height"
 */
export function calculateAspectRatio(width, height) {
	const divisor = calculateGCD(width, height);
	return `${width / divisor}:${height / divisor}`;
}

/**
 * Safely retrieves nested property from object using dot notation.
 * @param {Object} obj - Source object
 * @param {string} path - Dot-notation path (e.g., 'media_details.width')
 * @param {*} defaultValue - Default value if path doesn't exist
 * @returns {*} Retrieved value or default
 */
export function getNestedProperty(obj, path, defaultValue = '') {
	return path.split('.').reduce((acc, part) => acc?.[part], obj) ?? defaultValue;
}
