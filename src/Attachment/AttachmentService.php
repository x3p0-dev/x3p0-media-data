<?php

/**
 * Attachment media architecture.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Attachment;

use X3P0\MediaData\Contracts\{
	MediaData,
	MediaFactory,
	MediaRepository,
	MediaService
};

/**
 * Service for handling attachment/media operations. Coordinates between factory
 * (creation) and repository (storage).
 */
class AttachmentService implements MediaService
{
	public function __construct(
		private MediaRepository $repository,
		private MediaFactory $factory
	) {}

	/**
	 * {@inheritDoc}
	 */
	public function find(int $mediaId): ?MediaData
	{
		// Return from cache if available.
		if ($this->repository->has($mediaId)) {
			return $this->repository->find($mediaId);
		}

		// Create new instance via factory.
		$mediaData = $this->factory->make($mediaId);

		// Cache the result (even if null, to avoid repeated lookups).
		$this->repository->save($mediaId, $mediaData);

		return $mediaData;
	}

	/**
	 * Checks if a media item exists and is valid.
	 */
	public function exists(int $mediaId): bool
	{
		return $this->find($mediaId) !== null;
	}
}
