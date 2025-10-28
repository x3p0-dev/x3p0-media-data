<?php

/**
 * Media interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Media implementations represent an immutable data value object. They are
 * meant primarily as a data store for media that can be passed between to
 * consuming classes.
 */
interface Media
{
	/**
	 * The media ID.
	 */
	public function mediaId(): int;

	/**
	 * An array of string-keyed data which can have a mixed value type.
	 */
	public function data(): array;

	/**
	 * Determines whether a particular data value exists by key.
	 */
	public function has(string $key): bool;

	/**
	 * Returns a specific data value by key.
	 */
	public function get(string $key): mixed;
}
