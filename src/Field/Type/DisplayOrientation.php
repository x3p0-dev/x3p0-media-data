<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Dimensions field - displays media width and height.
 */
class DisplayOrientation extends Field
{
	public function label(): string
	{
		return __('Orientation', 'x3p0-media-data');
	}

	public function value(): ?string
	{
		$width  = $this->context->get('width');
		$height = $this->context->get('height');

		if (! $width || ! $height) {
			return null;
		}

		return match (true) {
			$width > $height => 'landscape',
			$height > $width => 'portrait',
			default          => 'square',
		};
	}

	public function render(): string
	{
		if (! $value = $this->value()) {
			return '';
		}

		return match ($value) {
			'landscape' => __('Landscape', 'x3p0-media-data'),
			'portrait'  => __('Portrait', 'x3p0-media-data'),
			default     => __('Square', 'x3p0-media-data')
		};
	}
}
