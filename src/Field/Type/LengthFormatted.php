<?php

/**
 * Length Formatted field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\BaseField;

/**
 * Displays the media's duration/length, formatted.
 */
class LengthFormatted extends BaseField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		return $this->media->get('length_formatted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Duration', 'x3p0-media-data');
	}
}
