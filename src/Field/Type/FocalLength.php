<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Aperture field - displays camera aperture for images.
 */
class FocalLength extends Field
{
	public function label(): string
	{
		return __('Focal Length', 'x3p0-media-data');
	}

	public function value(): mixed
	{
		return $this->context->get('focal_length');
	}

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
