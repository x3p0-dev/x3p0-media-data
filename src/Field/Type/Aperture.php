<?php

/**
 * Aperture field class.
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
 * Displays an image aperture.
 */
final class Aperture extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		return $this->media->get('aperture');
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $aperture = $this->getValue()) {
			return '';
		}

		return sprintf(
			'<sup>f</sup>&#8260;<sub>%s</sub>',
			absint($aperture)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Aperture', 'x3p0-media-data');
	}
}
