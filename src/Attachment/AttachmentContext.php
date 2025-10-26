<?php

/**
 * Attachment context class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Attachment;

use WP_Post;
use X3P0\MediaData\Contracts\MediaContext;

/**
 * Immutable value object that carries all the data a field might need. Acts as
 * a data transfer object between MediaData and field instances.
 */
class AttachmentContext implements MediaContext
{
	/**
	 * Creates a new media context.
	 */
	public function __construct(private ?WP_Post $post, private array $metadata)
	{
	}

	/**
	 * Gets the attachment post ID.
	 */
	public function mediaId(): ?int
	{
		return $this->post?->ID ?? null;
	}

	/**
	 * Gets the raw attachment metadata array.
	 */
	public function data(): array
	{
		return $this->metadata;
	}

	/**
	 * Checks if a metadata key exists.
	 */
	public function has(string $key): bool
	{
		return $this->get($key) !== null;
	}

	/**
	 * Gets a value from the metadata array.
	 */
	public function get(string $key): mixed
	{
		return $this->metadata[$key]
			?? $this->metadata['image_meta'][$key]
			?? $this->metadata['audio'][$key]
			?? null;
	}
}
