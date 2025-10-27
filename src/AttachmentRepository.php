<?php
/**
 * WordPress attachment repository implementation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */
declare(strict_types=1);

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\{Media, MediaRepository};

final class AttachmentRepository implements MediaRepository
{
	/**
	 * Cache of Media instances indexed by media ID.
	 *
	 * @var array<int, Media|null>
	 */
	private array $cache = [];

	public function find(int $mediaId): ?Media
	{
		// Return cached result if available
		if ($this->has($mediaId)) {
			return $this->cache[$mediaId];
		}

		// Verify the attachment exists
		if ('attachment' !== get_post_type($mediaId)) {
			$this->save($mediaId, null);
			return null;
		}

		// Get attachment metadata
		$metadata = wp_get_attachment_metadata($mediaId);

		$media = new Attachment($mediaId, $metadata ?: []);

		$this->save($mediaId, $media);

		return $media;
	}

	public function save(int $mediaId, ?Media $media): void
	{
		$this->cache[$mediaId] = $media;
	}

	public function delete(int $mediaId): void
	{
		unset($this->cache[$mediaId]);
	}

	public function has(int $mediaId): bool
	{
		return array_key_exists($mediaId, $this->cache);
	}
}
