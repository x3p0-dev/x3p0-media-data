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
	FieldFactory,
	FieldRegistry,
	Field,
	MediaRepository
};

/**
 * The media field service encapsulates the logic of building and accessing data
 * for a specific media field.
 */
final class MediaFieldService
{
	/**
	 * Accepts a media repository, field registry, and field factory, which
	 * are used to handle the more complex operations behind the scenes.
	 */
	public function __construct(
		private MediaRepository $repository,
		private FieldRegistry   $registry,
		private FieldFactory    $factory
	) {}

	/**
	 * Returns a media field object or `null`. This method will also return
	 * `null` if a field exists but simply doesn't have data to show.
	 */
	public function getField(int $mediaId, string $key): ?Field
	{
		// Get media data from repository
		$media = $this->repository->find($mediaId);

		// If no media found or field is not registered, bail.
		if (! $media || ! $this->registry->isRegistered($key)) {
			return null;
		}

		// Create field instance.
		$field = $this->factory->make($key, $media);

		// Return the field if it exists and has a value.
		return $field && $field->hasValue() ? $field : null;
	}
}
