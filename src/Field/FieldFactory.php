<?php

/**
 * Field factory class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Contracts\Field;
use X3P0\MediaData\Media\MediaContext;

/**
 * Factory for creating field instances. Consults the field registry to
 * determine which field class to instantiate for a given key.
 */
class FieldFactory
{
	/**
	 * Sets up the factory with its dependencies.
	 */
	public function __construct(private FieldRegistry $registry)
	{
	}

	/**
	 * Creates a field instance for the given key and context.
	 */
	public function make(string $key, MediaContext $context): ?Field
	{
		if (! $this->registry->isRegistered($key)) {
			return null;
		}

		$fieldClass = $this->registry->get($key);

		return new $fieldClass($context);
	}
}
