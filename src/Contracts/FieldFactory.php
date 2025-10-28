<?php

/**
 * Field Factory interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * The Field Factory makes new Media Fields. It's a factory, which makes things.
 */
interface FieldFactory
{
	/**
	 * Creates a new Media Field. The key should be a registered field type.
	 */
	public function make(string $key, Media $media): ?Field;
}
