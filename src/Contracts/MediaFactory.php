<?php

/**
 * Media factory interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Factory for creating `MediaData` instances.
 */
interface MediaFactory
{
	/**
	 * Creates an `MediaData` instance from a media ID.
	 */
	public function make(int $mediaId): ?MediaData;
}
