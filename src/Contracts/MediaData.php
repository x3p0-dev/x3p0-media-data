<?php

/**
 * Media data interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Manages field data for a single media attachment. Coordinates between the
 * field system and raw WordPress attachment metadata, caching field instances
 * for performance.
 */
interface MediaData
{
	/**
	 * Returns the raw data array.
	 */
	public function data(): array;

	/**
	 * Checks if the field exists and has a value for this media.
	 */
	public function has(string $key): bool;

	/**
	 * Returns the escaped and formatted field value.
	 */
	public function render(string $key): string;

	/**
	 * Returns the escaped and internationalized field label.
	 */
	public function renderLabel(string $key): string;
}
