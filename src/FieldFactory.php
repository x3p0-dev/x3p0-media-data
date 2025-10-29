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

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\{
	FieldFactory as FieldFactoryContract,
	FieldRegistry,
	Media,
	Field
};

/**
 * Registry-based field factory implementation.
 *
 * Creates field instances by looking up their class names in the field registry.
 * This is the default implementation of the interface because there's no current
 * expectation that additional implementations will be necessary.
 */
final class FieldFactory implements FieldFactoryContract
{
	/**
	 * Accepts an instance of the field registry, which is used for creating
	 * new field objects.
	 */
	public function __construct(
		private FieldRegistry $registry
	) {}

	/**
	 * {@inheritDoc}
	 */
	public function make(string $key, Media $media): ?Field
	{
		$fieldClass = $this->registry->get($key);

		return $fieldClass ? new $fieldClass($media) : null;
	}
}
