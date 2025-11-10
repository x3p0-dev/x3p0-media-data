<?php

/**
 * Attachment Repository class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Media;

/**
 * Repository implementation that stores attachment media objects by post ID.
 * This implementation acts as both a repository and factory. The `find()`
 * method creates new attachment objects when one is not found. We can later add
 * a separate media factory if necessary.
 */
final class MediaRepository
{
	/**
	 * Cache of Media instances indexed by media ID.
	 *
	 * @var array<int, Media|null>
	 */
	private array $cache = [];

	/**
	 * Finds a `Media` instance by media ID. Creates and caches if not
	 * already loaded.
	 */
	public function find(int $mediaId): ?Media
	{
		// Return cached result if available
		if ($this->has($mediaId)) {
			return $this->cache[$mediaId];
		}

		// Verify the attachment exists. If not, cache a `null` value to
		// avoid future lookups.
		if ('attachment' !== get_post_type($mediaId)) {
			$this->save($mediaId, null);
			return null;
		}

		// Get attachment metadata.
		$metadata = wp_get_attachment_metadata($mediaId);

		// Create and cache the new attachment object.
		$this->save($mediaId, new Media($mediaId, $metadata ?: []));

		// Return the cached attachment object.
		return $this->cache[$mediaId];
	}

	/**
	 * Caches a `Media` instance or `null` by media ID.
	 */
	public function save(int $mediaId, ?Media $media): void
	{
		$this->cache[$mediaId] = $media;
	}

	/**
	 * Deletes a specific instance from the cache.
	 */
	public function delete(int $mediaId): void
	{
		unset($this->cache[$mediaId]);
	}

	/**
	 * Checks if media exists in the cache.
	 */
	public function has(int $mediaId): bool
	{
		return array_key_exists($mediaId, $this->cache);
	}
}
