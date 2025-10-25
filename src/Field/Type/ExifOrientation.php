<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Dimensions field - displays media width and height.
 */
class ExifOrientation extends Field
{
	public function label(): string
	{
		return __('EXIF Orientation', 'x3p0-media-data');
	}

	public function value(): ?int
	{
		$orientation = $this->context->get('orientation');

		return is_numeric($orientation) && $orientation >= 1 && $orientation <= 8
			? absint($orientation)
			: null;
	}

	public function render(): string
	{
		if (! $value = $this->value()) {
			return '';
		}

		return match ($value) {
			1 => __('Normal', 'x3p0-media-data'),
			2 => __('Mirrored Horizontally', 'x3p0-media-data'),
			3 => __('Rotated 180&deg;', 'x3p0-media-data'),
			4 => __('Mirrored Vertically', 'x3p0-media-data'),
			5 => __('Rotated 90&deg;, Mirrored Horizontally', 'x3p0-media-data'),
			6 => __('Rotated 90&deg;', 'x3p0-media-data'),
			7 => __('Rotated 270&deg;, Mirrored Horizontally', 'x3p0-media-data'),
			8 => __('Rotated 270&deg;', 'x3p0-media-data'),
			default => ''
		};
	}
}
