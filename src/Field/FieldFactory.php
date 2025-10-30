<?php

/**
 * Field factory implementation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Media\Media;

/**
 * Creates field instances by looking up their class names in the field registry.
 */
final class FieldFactory
{
	/**
	 * Accepts an instance of the field registry, which is used for creating
	 * new field objects.
	 */
	public function __construct(protected FieldRegistry $registry)
	{}

	/**
	 * Creates a new Media Field. The key should be a registered field.
	 */
	public function make(string $key, Media $media): ?Field
	{
		$fieldClass = $this->registry->get($key);

		return $fieldClass ? new $fieldClass($media) : null;
	}
}
