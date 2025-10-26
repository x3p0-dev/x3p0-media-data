<?php

/**
 * Focal Length field class.
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
 * Displays the image focal length.
 */
class FocalLength extends BaseField
{
	/**
	 * {@inheritDoc}
	 */
	public function renderLabel(): string
	{
		return esc_html__('Focal Length', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): mixed
	{
		return $this->context->get('focal_length');
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		if (! $focal = $this->value()) {
			return '';
		}

		return sprintf(
			// Translators: %s is the focal length of a camera.
			esc_html__('%s mm', 'x3p0-media-data'),
			floatval($focal)
		);
	}
}
