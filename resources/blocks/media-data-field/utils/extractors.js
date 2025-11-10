/**
 * Media data field extractors.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {EXIF_ORIENTATIONS} from './constants';
import {formatAperture, formatFileSize, formatShutterSpeed} from './formatters';
import {calculateAspectRatio, getNestedProperty} from './helpers';

import {__, sprintf} from '@wordpress/i18n';
import {dateI18n} from '@wordpress/date';

/**
 * Field extractors for WordPress media objects
 * Each function takes a media object and returns a formatted field value
 */
const mediaFieldExtractors = {
	/**
	 * Gets album name
	 */
	album: (media) => getNestedProperty(media, 'media_details.album'),

	/**
	 * Gets aperture value formatted as f-stop
	 */
	aperture: (media) => {
		const aperture = getNestedProperty(media, 'media_details.image_meta.aperture');
		return aperture ? formatAperture(aperture) : '';
	},

	/**
	 * Gets artist name
	 */
	artist: (media) => getNestedProperty(media, 'media_details.artist'),

	/**
	 * Calculates and returns aspect ratio
	 */
	aspect_ratio: (media) => {
		const width = getNestedProperty(media, 'media_details.width');
		const height = getNestedProperty(media, 'media_details.height');
		return width && height ? calculateAspectRatio(width, height) : '';
	},

	/**
	 * Gets camera model
	 */
	camera: (media) => getNestedProperty(media, 'media_details.image_meta.camera'),

	/**
	 * Gets formatted creation timestamp
	 */
	created_timestamp: (media) => {
		const timestamp = getNestedProperty(media, 'media_details.created_timestamp')
			|| getNestedProperty(media, 'media_details.image_meta.created_timestamp');

		return timestamp ? dateI18n('F j, Y', new Date(timestamp * 1000)) : '';
	},

	/**
	 * Gets dimensions in "width × height" format
	 */
	dimensions: (media) => {
		const width = getNestedProperty(media, 'media_details.width');
		const height = getNestedProperty(media, 'media_details.height');

		return width && height
			? sprintf(
				// Translators: Media dimensions - 1 is width and 2 is height.
				__('%1$s &#215; %2$s', 'x3p0-media-data'),
				width.toLocaleString(),
				height.toLocaleString()
			)
			: '';
	},

	/**
	 * Determines display orientation (Landscape/Portrait/Square)
	 */
	display_orientation: (media) => {
		const width = getNestedProperty(media, 'media_details.width');
		const height = getNestedProperty(media, 'media_details.height');

		if (!width || !height) {
			return '';
		}

		if (width > height) {
			return __('Landscape', 'x3p0-media-data');
		}
		if (height > width) {
			return __('Portrait', 'x3p0-media-data');
		}
		return __('Square', 'x3p0-media-data');
	},

	/**
	 * Extracts filename from full path
	 */
	file_name: (media) => {
		let file = getNestedProperty(media, 'media_details.file');

		// Use the source URL if file meta not found
		if (!file) {
			file = media?.source_url ?? '';
		}

		return file ? file.split(/[\\/]/).pop() : '';
	},

	/**
	 * Formats file size
	 */
	file_size: (media) => {
		const filesize = getNestedProperty(media, 'media_details.filesize');
		return filesize ? formatFileSize(Math.abs(Math.floor(filesize)), 2) : '';
	},

	/**
	 * Gets focal length in millimeters
	 */
	focal_length: (media) => {
		const focalLength = getNestedProperty(media, 'media_details.image_meta.focal_length');
		return focalLength
			? sprintf(__('%s mm', 'x3p0-media-data'), focalLength)
			: '';
	},

	/**
	 * Gets genre
	 */
	genre: (media) => getNestedProperty(media, 'media_details.genre'),

	/**
	 * Gets ISO speed
	 */
	iso: (media) => getNestedProperty(media, 'media_details.image_meta.iso'),

	/**
	 * Gets formatted media length (for audio/video)
	 */
	length_formatted: (media) => getNestedProperty(media, 'media_details.length_formatted'),

	/**
	 * Gets MIME type
	 */
	mime_type: (media) => getNestedProperty(media, 'mime_type'),

	/**
	 * Gets EXIF orientation value
	 */
	orientation: (media) => {
		const orientation = getNestedProperty(media, 'media_details.image_meta.orientation');
		return orientation && EXIF_ORIENTATIONS[orientation]
			? EXIF_ORIENTATIONS[orientation]
			: '';
	},

	/**
	 * Gets formatted shutter speed
	 */
	shutter_speed: (media) => {
		const speed = getNestedProperty(media, 'media_details.image_meta.shutter_speed');
		return formatShutterSpeed(speed);
	},

	/**
	 * Gets rendered title
	 */
	title: (media) => getNestedProperty(media, 'title.rendered'),

	/**
	 * Gets track number
	 */
	track_number: (media) => getNestedProperty(media, 'media_details.track_number'),

	/**
	 * Gets year
	 */
	year: (media) => getNestedProperty(media, 'media_details.year')
};

/**
 * Gets a specific field value from a WordPress media object.
 * @param   {Object} media WordPress media object.
 * @param   {string} fieldName Name of field to extract.
 * @returns {string} Formatted field value or empty string if not found.
 */
export function getMediaField(media, fieldName) {
	const extractor = mediaFieldExtractors[fieldName];
	return extractor ? extractor(media) : '';
}
