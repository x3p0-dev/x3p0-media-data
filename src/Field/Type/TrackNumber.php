<?php

/**
 * Track Number field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Displays the audio track number from an album.
 */
class TrackNumber extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('Track Number', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): string|int|null
	{
		return $this->context->get('track_number');
	}
}
