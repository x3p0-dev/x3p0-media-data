<?php

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

class AspectRatio extends Field
{
	public function label(): string
	{
		return __('Aspect Ratio', 'x3p0-media-data');
	}

	public function value(): ?array
	{
		$width  = $this->context->get('width');
		$height = $this->context->get('height');

		if (! $width || ! $height) {
			return null;
		}

		// Calculate GCD for aspect ratio
		$gcd = function($a, $b) use (&$gcd) {
			return $b ? $gcd($b, $a % $b) : $a;
		};

		$divisor = $gcd($width, $height);

		return [
			'width'  => $width / $divisor,
			'height' => $height / $divisor
		];
	}

	public function render(): string
	{
		$ratio = $this->value();

		if (! $ratio) {
			return '';
		}

		return esc_html(sprintf(
			'%d:%d',
			$ratio['width'],
			$ratio['height']
		));
	}
}
