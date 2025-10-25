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

use WP_Post;
use X3P0\MediaData\Field\FieldFactory;
use X3P0\MediaData\Field\FieldRegistry;

/**
 * Manages MediaData instances, ensuring only one instance exists per post ID.
 * Acts as a factory and cache for MediaData objects.
 */
class MediaRepository
{
	/**
	 * Stores MediaData instances keyed by post ID.
	 */
	private array $instances = [];

	/**
	 * Sets up the repository with its dependencies.
	 */
	public function __construct(private FieldFactory $fieldFactory) {}

	/**
	 * Gets or creates a MediaData instance for the given post ID.
	 */
	public function get(int $postId): ?MediaData
	{
		// Return cached instance if it exists.
		if (isset($this->instances[$postId])) {
			return $this->instances[$postId];
		}

		// Get the post object.
		$post = get_post($postId);

		// Validate that this is an attachment post.
		if (! $post instanceof WP_Post || 'attachment' !== get_post_type($post)) {
			// Cache null to avoid repeated lookups for invalid IDs.
			$this->instances[$postId] = null;
			return null;
		}

		// Create and cache the instance.
		$this->instances[$postId] = new MediaData($post, $this->fieldFactory);

		return $this->instances[$postId];
	}

	/**
	 * Clears a specific MediaData instance from the cache.
	 * Useful when attachment metadata is updated.
	 */
	public function clear(int $postId): void
	{
		unset($this->instances[$postId]);
	}

	/**
	 * Clears all cached MediaData instances.
	 */
	public function clearAll(): void
	{
		$this->instances = [];
	}

	/**
	 * Checks if a MediaData instance is cached for the given post ID.
	 */
	public function has(int $postId): bool
	{
		return isset($this->instances[$postId]);
	}
}
