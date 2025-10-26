<?php

/**
 * Aspect Ratio field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */


namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Displays the media aspect ratio (generally for image and video types).
 */
class AspectRatio extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('Aspect Ratio', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
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

	/**
	 * {@inheritDoc}
	 */
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
