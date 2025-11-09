<?php

/**
 * Field interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Media\Media;

interface Field
{
	/**
	 * Checks if the field has a value for the current media.
	 */
	public function hasValue(): bool;

	/**
	 * Returns the raw, unformatted value of the field.
	 */
	public function getValue(): mixed;

	/**
	 * Returns the escaped and formatted field value as a string.
	 */
	public function renderValue(): string;

	/**
	 * Returns the field label.
	 */
	public function getLabel(): string;
}
