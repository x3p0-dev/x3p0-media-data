<?php

/**
 * Title field class.
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
 * Displays the media title.
 */
final class Title extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): string
	{
		return get_the_title($this->media->id());
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		return wp_strip_all_tags($this->getValue());
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Title', 'x3p0-media-data');
	}
}
