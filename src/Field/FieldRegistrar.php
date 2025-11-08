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
	public const ALBUM = 'album';
	public const APERTURE = 'aperture';
	public const ARTIST = 'artist';
	public const ASPECT_RATIO = 'aspect_ratio';
	public const CAMERA = 'camera';
	public const CREATED_TIMESTAMP = 'created_timestamp';
	public const DIMENSIONS = 'dimensions';
	public const DISPLAY_ORIENTATION = 'display_orientation';
	public const FILE_SIZE = 'file_size';
	public const FILE_NAME = 'file_name';
	public const FOCAL_LENGTH = 'focal_length';
	public const GENRE = 'genre';
	public const ISO = 'iso';
	public const LENGTH_FORMATTED = 'length_formatted';
	public const MIME_TYPE = 'mime_type';
	public const ORIENTATION = 'orientation';
	public const SHUTTER_SPEED = 'shutter_speed';
	public const TITLE = 'title';
	public const TRACK_NUMBER = 'track_number';
	public const YEAR = 'year';

	/**
	 * An array of field keys and their associated classes, to be stored in
	 * the field registry.
	 */
	private static function getFields(): array
	{
		return [
			self::ALBUM               => Type\Album::class,
			self::APERTURE            => Type\Aperture::class,
			self::ARTIST              => Type\Artist::class,
			self::ASPECT_RATIO        => Type\AspectRatio::class,
			self::CAMERA              => Type\Camera::class,
			self::CREATED_TIMESTAMP   => Type\CreatedTimestamp::class,
			self::DIMENSIONS          => Type\Dimensions::class,
			self::DISPLAY_ORIENTATION => Type\DisplayOrientation::class,
			self::FILE_SIZE           => Type\FileSize::class,
			self::FILE_NAME           => Type\FileName::class,
			self::FOCAL_LENGTH        => Type\FocalLength::class,
			self::GENRE               => Type\Genre::class,
			self::ISO                 => Type\Iso::class,
			self::LENGTH_FORMATTED    => Type\LengthFormatted::class,
			self::MIME_TYPE           => Type\MimeType::class,
			self::ORIENTATION         => Type\ExifOrientation::class,
			self::SHUTTER_SPEED       => Type\ShutterSpeed::class,
			self::TITLE               => Type\Title::class,
			self::TRACK_NUMBER        => Type\TrackNumber::class,
			self::YEAR                => Type\Year::class
		];
	}

	/**
	 * Registers default fields with the registry.
	 */
	public static function register(FieldRegistry $fieldRegistry): void
	{
		foreach (self::getFields() as $key => $className) {
			$fieldRegistry->register($key, $className);
		}
	}
}
