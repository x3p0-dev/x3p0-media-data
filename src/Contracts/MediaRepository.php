<?php

/**
 * Media repository interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Manages MediaData instances, ensuring only one instance exists per post ID.
 * Acts as a factory and cache for MediaData objects.
 */
interface MediaRepository
{
	/**
	 * Finds a MediaData instance by post ID. Creates and caches if not
	 * already loaded.
	 */
	public function find(int $mediaId): ?Media;

	/**
	 * Caches a `MediaMeta` instance or `null` by post ID.
	 */
	public function save(int $mediaId, ?Media $media): void;

	/**
	 * Deletes a specific instance from the cache.
	 */
	public function delete(int $mediaId): void;

	/**
	 * Checks if media data exists in the cache.
	 */
	public function has(int $mediaId): bool;
}
