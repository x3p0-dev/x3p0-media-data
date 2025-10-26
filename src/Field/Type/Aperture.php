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
 * Displays an image aperture field.
 */
class Aperture extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('Aperture', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): mixed
	{
		return $this->context->get('aperture');
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		$aperture = $this->value();

		if (! $aperture) {
			return '';
		}

		return sprintf(
			'<sup>f</sup>&#8260;<sub>%s</sub>',
			absint($aperture)
		);
	}
}
