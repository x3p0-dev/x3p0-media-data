<?php

/**
 * Media context class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Media;

use WP_Post;

/**
 * Immutable value object that carries all the data a field might need.
 * Acts as a data transfer object between MediaData and field instances.
 */
class MediaContext
{
	/**
	 * Creates a new media context.
	 */
	public function __construct(private ?WP_Post $post, private array $metadata)
	{
	}

	/**
	 * Gets the attachment post object.
	 */
	public function post(): ?WP_Post
	{
		return $this->post;
	}

	/**
	 * Gets the raw attachment metadata array.
	 */
	public function metadata(): array
	{
		return $this->metadata;
	}

	/**
	 * Gets the attachment post ID.
	 */
	public function postId(): ?int
	{
		return $this->post?->ID ?? null;
	}

	/**
	 * Checks if a metadata key exists.
	 */
	public function has(string $key, string $type = ''): bool
	{
		return match ($type) {
			'image' => isset($this->metadata['image_meta'][$key]),
			'audio' => isset($this->metadata['audio'][$key]),
			default => isset($this->metadata[$key])
		};
	}

	/**
	 * Gets a value from the metadata array.
	 */
	public function get(string $key): mixed
	{
		if ($this->has($key)) {
			return $this->metadata[$key];
		} elseif ($this->has($key, 'image')) {
			return $this->metadata['image_meta'][$key];
		} elseif ($this->has($key, 'audio')) {
			return $this->metadata['audio'][$key];
		}

		return null;
	}
}
