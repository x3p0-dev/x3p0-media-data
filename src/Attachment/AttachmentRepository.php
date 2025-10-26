<?php

/**
 * Attachment data repository.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Attachment;

use X3P0\MediaData\Contracts\{MediaData, MediaRepository};

/**
 * Manages MediaData instances, ensuring only one instance exists per post ID.
 * Acts as a factory and cache for MediaData objects.
 */
class AttachmentRepository implements MediaRepository
{
	/**
	 * Stores `MediaData` instances, keyed by post ID.
	 */
	private array $instances = [];

	/**
	 * {@inheritDoc}
	 */
	public function find(int $mediaId): ?MediaData
	{
		return $this->instances[$mediaId] ?? null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function save(int $mediaId, ?MediaData $mediaData): void
	{
		$this->instances[$mediaId] = $mediaData;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete(int $mediaId): void
	{
		unset($this->instances[$mediaId]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function has(int $mediaId): bool
	{
		return isset($this->instances[$mediaId]);
	}
}
