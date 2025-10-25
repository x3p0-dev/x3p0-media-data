<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Aperture field - displays camera aperture for images.
 */
class ShutterSpeed extends Field
{
	public function label(): string
	{
		return __('Shutter Speed', 'x3p0-media-data');
	}

	public function value(): mixed
	{
		return $this->context->get('shutter_speed');
	}

	public function render(): string
	{
		if (! $shutter = $this->value()) {
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
