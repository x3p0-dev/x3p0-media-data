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

namespace X3P0\MediaData\Contracts;

use X3P0\MediaData\Media\MediaContext;

/**
 * Contract that all field classes must implement. Fields are responsible for
 * retrieving, formatting, and rendering specific pieces of media data.
 */
interface Field
{
	/**
	 * Creates a new field instance with the given context.
	 */
	public function __construct(MediaContext $context);

	/**
	 * Checks if the field has a value for the current media.
	 */
	public function exists(): bool;

	/**
	 * Returns the raw, unformatted value of the field.
	 */
	public function value(): mixed;

	/**
	 * Returns the escaped and formatted field value as a string.
	 */
	public function render(): string;

	public function label(): string;
}
