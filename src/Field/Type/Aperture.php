<?php
declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Aperture field - displays camera aperture for images.
 */
class Aperture extends Field
{
	public function label(): string
	{
		return __('Aperture', 'x3p0-media-data');
	}

	public function value(): mixed
	{
		return $this->context->get('aperture');
	}

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
