<?php

/**
 * Field interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Fields are meant for getting data from a Media object.
 */
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
