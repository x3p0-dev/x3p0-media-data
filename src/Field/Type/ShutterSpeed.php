<?php

/**
 * Shutter Speed field class.
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
 * Displays the image camera shutter speed.
 */
class ShutterSpeed extends BaseField
{
	/**
	 * {@inheritDoc}
	 */
	public function renderLabel(): string
	{
		return esc_html__('Shutter Speed', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		return $this->media->get('shutter_speed');
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		if (! $shutter = $this->getValue()) {
			return '';
		}

		$shutter = $speed = floatval(wp_strip_all_tags($shutter));

		if ((1 / $speed) > 1) {
			$num_float   = number_format((1 / $speed), 1);
			$num_integer = number_format((1 / $speed), 0);

			$formatted_num = $num_float === $num_integer
				? number_format_i18n((1 / $speed), 0, '.', '')
				: number_format_i18n((1 / $speed), 1, '.', '');

			$shutter = sprintf(
				'<sup>%s</sup>&#8260;<sub>%s</sub>',
				esc_html(number_format_i18n(1)),
				esc_html($formatted_num)
			);
		}

		return sprintf(
			// Translators: %s is the shutter speed of a camera.
			esc_html__('%s sec', 'x3p0-media-data'),
			$shutter
		);
	}
}
