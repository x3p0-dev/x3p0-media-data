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

use X3P0\MediaData\Field\Field;

/**
 * Displays the image focal length.
 */
final class FocalLength extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		return $this->media->get('focal_length');
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $focal = $this->getValue()) {
			return '';
		}

		return sprintf(
			// Translators: %s is the focal length of a camera.
			esc_html__('%s mm', 'x3p0-media-data'),
			floatval($focal)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Focal Length', 'x3p0-media-data');
	}
}
