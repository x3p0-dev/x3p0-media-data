<?php

/**
 * Media context interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

use WP_Post;

/**
 * Immutable value object that carries all the data a field might need. Acts as
 * a data transfer object between MediaData and field instances.
 */
interface MediaContext
{
	/**
	 * Gets the media ID.
	 */
	public function mediaId(): ?int;

	/**
	 * Gets the raw data array.
	 */
	public function data(): array;

	/**
	 * Checks if a data key exists.
	 */
	public function has(string $key): bool;

	/**
	 * Gets a value from the data array.
	 */
	public function get(string $key): mixed;
}
