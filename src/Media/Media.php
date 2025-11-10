<?php

/**
 * Attachment media class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Media;

/**
 * Wrapper around the WordPress `attachment` post type for getting post data or
 * its media file metadata. This implementation essentially acts as a data store
 * for consuming classes, hiding the complexities of accessing data via simple
 * API methods.
 */
final class Media
{
	/**
	 * Accepts an attachment ID and an array of attachment metadata.
	 */
	public function __construct(
		private readonly int $id,
		private readonly array $data
	) {}

	/**
	 * Returns the media ID.
	 */
	public function id(): int
	{
		return $this->id;
	}

	/**
	 * Returns an array of string-keyed data which can have a mixed type.
	 */
	public function data(): array
	{
		return $this->data;
	}

	/**
	 * Determines whether a particular data value exists by key.
	 */
	public function has(string $key): bool
	{
		return $this->get($key) !== null;
	}

	/**
	 * Returns a specific data value by key.
	 */
	public function get(string $key): mixed
	{
		return $this->data[$key]
			?? $this->data['image_meta'][$key]
			?? $this->data['audio'][$key]
			?? null;
	}
}
