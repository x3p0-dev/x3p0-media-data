<?php

/**
 * Media field service.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\{
	Field,
	FieldFactory,
	FieldRegistry,
	FieldService,
	MediaRepository
};

/**
 * The media field service encapsulates the logic of building and accessing data
 * for a specific media field.
 */
final class MediaFieldService implements FieldService
{
	/**
	 * Accepts a media repository, field registry, and field factory, which
	 * are used to handle the more complex operations behind the scenes.
	 */
	public function __construct(
		private MediaRepository $mediaRepository,
		private FieldRegistry   $fieldRegistry,
		private FieldFactory    $fieldFactory
	) {}

	/**
	 * Returns a media field object or `null`. This method will also return
	 * `null` if a field exists but simply doesn't have data to show.
	 */
	public function getField(int $mediaId, string $fieldKey): ?Field
	{
		// Get media data from repository
		$media = $this->mediaRepository->find($mediaId);

		// If no media found or field is not registered, bail.
		if (! $media || ! $this->fieldRegistry->isRegistered($fieldKey)) {
			return null;
		}

		// Create field instance.
		$field = $this->fieldFactory->make($fieldKey, $media);

		// Return the field if it exists and has a value.
		return $field && $field->hasValue() ? $field : null;
	}
}
