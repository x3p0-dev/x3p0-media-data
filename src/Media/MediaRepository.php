<?php

/**
 * Media repository class.
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
 * The `find()` method will use the media factory to create a new media object
 * if one is not already stored and the ID is valid.
 */
final class MediaRepository
{
	/**
	 * Cache of Media instances indexed by media ID. By default, the cache
	 * includes the ID of `0` as `null`, which will bypass lookups for it.
	 *
	 * @var array<int, Media|null>
	 */
	private array $cache = [0 => null];

	/**
	 * Sets up the initial object state.
	 */
	public function __construct(private readonly MediaFactory $mediaFactory)
	{}

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
		$metadata = wp_get_attachment_metadata($mediaId) ?: [];

		// Create and cache the new media object.
		$this->save($mediaId, $this->mediaFactory->make($mediaId, $metadata));

		// Return the cached media object.
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
