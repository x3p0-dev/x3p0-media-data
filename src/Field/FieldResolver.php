<?php

/**
 * Field resolver.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Media\MediaRepository;

/**
 * Resolves media fields by coordinating the media repository and field factory
 * to return fully hydrated field objects.
 */
final class FieldResolver
{
	/**
	 * Accepts a media repository and field factory, which are used to
	 * handle the more complex operations behind the scenes.
	 */
	public function __construct(
		private MediaRepository $mediaRepository,
		private FieldFactory    $fieldFactory
	) {}

	/**
	 * Returns a media field object or `null`. This method will also return
	 * `null` if a field exists but simply doesn't have data to show.
	 */
	public function resolve(int $mediaId, string $fieldKey): ?Field
	{
		// Get media data from repository
		if (! $media = $this->mediaRepository->find($mediaId)) {
			return null;
		}

		// Create field instance.
		$field = $this->fieldFactory->make($fieldKey, $media);

		// Return the field if it exists and has a value.
		return $field && $field->hasValue() ? $field : null;
	}
}
