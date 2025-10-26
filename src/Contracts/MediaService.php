<?php

/**
 * Media service pattern.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Service for handling media operations. Coordinates between factory (creation)
 * and repository (storage).
 */
interface MediaService
{
	/**
	 * Finds media data by ID, creating and caching if needed.
	 * This is the primary method for retrieving media.
	 */
	public function find(int $mediaId): ?MediaData;

	/**
	 * Checks if a media item exists and is valid.
	 */
	public function exists(int $mediaId): bool;
}
