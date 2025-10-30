<?php

/**
 * Field registrar.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

/**
 * Static helper class for registering the default fields for the plugin.
 */
final class FieldRegistrar
{
	/**
	 * An array of field keys and their associated classes, to be stored in
	 * the field registry.
	 */
	private const FIELDS = [
		'album'               => Type\Album::class,
		'aperture'            => Type\Aperture::class,
		'artist'              => Type\Artist::class,
		'aspect_ratio'        => Type\AspectRatio::class,
		'camera'              => Type\Camera::class,
		'created_timestamp'   => Type\CreatedTimestamp::class,
		'dimensions'          => Type\Dimensions::class,
		'display_orientation' => Type\DisplayOrientation::class,
		'file_size'           => Type\FileSize::class,
		'file_name'           => Type\FileName::class,
		'focal_length'        => Type\FocalLength::class,
		'genre'               => Type\Genre::class,
		'iso'                 => Type\Iso::class,
		'length_formatted'    => Type\LengthFormatted::class,
		'mime_type'           => Type\MimeType::class,
		'orientation'         => Type\ExifOrientation::class,
		'shutter_speed'       => Type\ShutterSpeed::class,
		'title'               => Type\Title::class,
		'track_number'        => Type\TrackNumber::class,
		'year'                => Type\Year::class
	];

	/**
	 * Registers default fields with the registry.
	 */
	public static function register(FieldRegistry $fieldRegistry): void
	{
		foreach (self::FIELDS as $key => $fieldClass) {
			$fieldRegistry->register($key, $fieldClass);
		}
	}
}
