<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Aperture field - displays camera aperture for images.
 */
class Iso extends Field
{
	public function value(): mixed
	{
		return $this->context->get('iso');
	}

	public function label(): string
	{
		return __('ISO', 'x3p0-media-data');
	}
}
