<?php

declare(strict_types=1);

namespace X3P0\MediaData\Media;

use WP_Post;
use X3P0\MediaData\Field\FieldFactory;

/**
 * Manages MediaData instances, ensuring only one instance exists per post ID.
 * Acts as a factory and cache for MediaData objects.
 */
class MediaRepository
{
	/**
	 * Stores `MediaData` instances, keyed by post ID.
	 */
	private array $instances = [];

	/**
	 * Sets up the initial object state.
	 */
	public function __construct(private FieldFactory $fieldFactory) {}

	/**
	 * Finds a MediaData instance by post ID. Creates and caches if not
	 * already loaded.
	 */
	public function find(int $postId): ?MediaData
	{
		if (isset($this->instances[$postId])) {
			return $this->instances[$postId];
		}

		$post = get_post($postId);

		// Validate that this is an attachment post.
		if (! $post instanceof WP_Post || 'attachment' !== get_post_type($post)) {
			$this->save($postId, null);
			return null;
		}

		$this->save($postId, new MediaData($post, $this->fieldFactory));

		return $this->instances[$postId];
	}

	/**
	 * Caches a `MediaMeta` instance or `null` by post ID.
	 */
	public function save(int $postId, ?MediaData $mediaData): void
	{
		$this->instances[$postId] = $mediaData;
	}

	/**
	 * Deletes a specific instance from the cache.
	 */
	public function delete(int $postId): void
	{
		unset($this->instances[$postId]);
	}
}
