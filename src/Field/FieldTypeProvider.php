<?php

/**
 * Field type provider.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Contracts\FieldTypeRegistry;

/**
 * Static helper class for registering the default field types for the plugin.
 */
class FieldTypeProvider
{
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
		'iso'                 => Type\ISO::class,
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
	public static function register(FieldTypeRegistry $registry): void
	{
		foreach (static::FIELDS as $name => $className) {
			$registry->register($name, $className);
		}
	}
}
