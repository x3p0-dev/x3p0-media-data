<?php

/**
 * Field service.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Describes the public API for encapsulating the business logic behind
 * accessing media fields.
 */
interface FieldService
{
	/**
	 * Returns a media field object or `null`.
	 */
	public function getField(int $mediaId, string $fieldKey): ?Field;
}
