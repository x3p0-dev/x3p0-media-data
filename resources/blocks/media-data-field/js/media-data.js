/**
 * Media Metadata Utility Module
 *
 * Provides functions for extracting and formatting media metadata
 * from WordPress media objects.
 */
import {__, _x, sprintf} from "@wordpress/i18n";
import {dateI18n} from "@wordpress/date";

// ============================================================================
// Constants
// ============================================================================

const EXIF_ORIENTATIONS = {
	1: __('Normal', 'x3p0-media-data'),
	2: __('Mirrored Horizontally', 'x3p0-media-data'),
	3: __('Rotated 180&deg;', 'x3p0-media-data'),
	4: __('Mirrored Vertically', 'x3p0-media-data'),
	5: __('Rotated 90&deg;, Mirrored Horizontally', 'x3p0-media-data'),
	6: __('Rotated 90&deg;', 'x3p0-media-data'),
	7: __('Rotated 270&deg;, Mirrored Horizontally', 'x3p0-media-data'),
	8: __('Rotated 270&deg;', 'x3p0-media-data')
};

const BYTE_UNITS = [
	{
		/* translators: Unit symbol for yottabyte. */
		unit: _x('YB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 8
	},
	{
		/* translators: Unit symbol for zettabyte. */
		unit: _x('ZB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 7
	},
	{
		/* translators: Unit symbol for exabyte. */
		unit: _x('EB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 6
	},
	{
		/* translators: Unit symbol for petabyte. */
		unit: _x('PB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 5
	},
	{
		/* translators: Unit symbol for terabyte. */
		unit: _x('TB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 4
	},
	{
		/* translators: Unit symbol for gigabyte. */
		unit: _x('GB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 3
	},
	{
		/* translators: Unit symbol for megabyte. */
		unit: _x('MB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024 ** 2
	},
	{
		/* translators: Unit symbol for kilobyte. */
		unit: _x('KB', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1024
	},
	{
		/* translators: Unit symbol for byte. */
		unit: _x('B', 'unit symbol', 'x3p0-media-data'),
		magnitude: 1
	}
];

// ============================================================================
// Utility Functions
// ============================================================================

/**
 * Calculates the greatest common divisor of two numbers
 * @param {number} a - First number
 * @param {number} b - Second number
 * @returns {number} The GCD
 */
function calculateGCD(a, b) {
	return b === 0 ? a : calculateGCD(b, a % b);
}

/**
 * Calculates the aspect ratio from width and height
 * @param {number} width - Image width
 * @param {number} height - Image height
 * @returns {string} Aspect ratio in format "width:height"
 */
function calculateAspectRatio(width, height) {
	const divisor = calculateGCD(width, height);
	return `${width / divisor}:${height / divisor}`;
}

/**
 * Formats bytes into human-readable file size
 * @param {number} bytes - File size in bytes
 * @param {number} decimals - Number of decimal places
 * @returns {string|boolean} Formatted size string or false
 */
function formatFileSize(bytes, decimals = 0) {
	if (bytes === 0) {
		/* translators: Unit symbol for byte. */
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
 * Formats a number with specified decimal places
 * @param {number} value - Number to format
 * @param {number} decimals - Number of decimal places
 * @returns {string} Formatted number
 */
function formatNumber(value, decimals) {
	return value.toLocaleString(undefined, {
		minimumFractionDigits: decimals,
		maximumFractionDigits: decimals
	});
}

/**
 * Formats shutter speed value
 * @param {string|number} value - Raw shutter speed value
 * @returns {string} Formatted shutter speed
 */
function formatShutterSpeed(value) {
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

/**
 * Safely retrieves nested property from object
 * @param {Object} obj - Source object
 * @param {string} path - Dot-notation path
 * @param {*} defaultValue - Default value if path doesn't exist
 * @returns {*} Retrieved value or default
 */
function getNestedProperty(obj, path, defaultValue = '') {
	return path.split('.').reduce((acc, part) => acc?.[part], obj) ?? defaultValue;
}

// ============================================================================
// Media Field Extractors
// ============================================================================

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
		return aperture
			? `<sup>f</sup>&#8260;<sub>${Math.abs(parseInt(aperture, 10))}</sub>`
			: '';
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

		// Use the source URL if file meta not found.
		if (! file) {
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

// ============================================================================
// Public API
// ============================================================================

/**
 * Gets a specific field value from media object
 * @param {Object} media - WordPress media object
 * @param {string} fieldName - Name of field to extract
 * @returns {string} Formatted field value
 */
export function getMediaField(media, fieldName) {
	const extractor = mediaFieldExtractors[fieldName];
	return extractor ? extractor(media) : '';
}
