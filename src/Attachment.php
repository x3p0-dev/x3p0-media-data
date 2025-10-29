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

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\Media;

/**
 * Wrapper around the WordPress `attachment` post type for getting data related
 * to the post itself or its metadata. This implementation makes hides away the
 * complexities of finding specific data with simple API functions.
 */
final class Attachment implements Media
{
	/**
	 * Accepts an attachment ID and an array of attachment metadata.
	 */
	public function __construct(
		private int   $id,
		private array $data
	) {}

	/**
	 * {@inheritDoc}
	 */
	public function id(): int
	{
		return $this->id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function data(): array
	{
		return $this->data;
	}

	/**
	 * {@inheritDoc}
	 */
	public function has(string $key): bool
	{
		return $this->get($key) !== null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get(string $key): mixed
	{
		return $this->data[$key]
			?? $this->data['image_meta'][$key]
			?? $this->data['audio'][$key]
			?? null;
	}
}
