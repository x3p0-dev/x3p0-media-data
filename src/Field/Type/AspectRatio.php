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

use X3P0\MediaData\Field\AbstractField;

/**
 * Displays the media aspect ratio (generally for image and video types).
 */
final class AspectRatio extends AbstractField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): ?array
	{
		$width  = $this->media->get('width');
		$height = $this->media->get('height');

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
	public function getLabel(): string
	{
		return __('Aspect Ratio', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $ratio = $this->getValue()) {
			return '';
		}

		return sprintf(
			'<div class="%s">%s</div>',
			$this->scopeClass('value'),
			esc_html(sprintf(
				'%d:%d',
				esc_html(number_format_i18n($ratio['width'])),
				esc_html(number_format_i18n($ratio['height']))
			))
		);
	}

	public function render(string $attrs, string $label = ''): string {
		if (! $this->hasValue()) {
			return '';
		}

		return sprintf(
			'<div %s>%s %s</div>',
			$attrs,
			$this->renderLabel($label),
			$this->renderValue()
		);
	}
}
