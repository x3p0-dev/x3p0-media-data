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
	FieldTypeRegistry,
	MediaField,
	MediaRepository
};

final class MediaFieldService
{
	public function __construct(
		private MediaRepository   $repository,
		private FieldTypeRegistry $registry,
		private FieldFactory      $factory
	) {}

	public function getField(int $mediaId, string $key): ?MediaField
	{
		// Get media data from repository
		$media = $this->repository->find($mediaId);

		// If no media found or field is not registered, bail.
		if (! $media || ! $this->registry->isRegistered($key)) {
			return null;
		}

		// Create field instance.
		$field = $this->factory->make($key, $media);

		// Return the field if data exists.
		return $field && $field->hasValue() ? $field : null;
	}
}
