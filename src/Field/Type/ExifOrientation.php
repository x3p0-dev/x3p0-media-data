<?php

/**
 * EXIF Orientation field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\AbstractField;

/**
 * Displays the image's EXIF orientation (values 1-8).
 */
final class ExifOrientation extends AbstractField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): ?int
	{
		$orientation = $this->media->get('orientation');

		return is_numeric($orientation) && $orientation >= 1 && $orientation <= 8
			? absint($orientation)
			: null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Orientation', 'x3p0-media-data');
	}

	protected function renderLabel(string $label = ''): string
	{
		return sprintf(
			'<div class="%s" property="name">%s</div>',
			$this->scopeClass('label'),
			$label ?: $this->getLabel()
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $value = $this->getValue()) {
			return '';
		}

		$orientation = match ($value) {
			2 => __('Mirrored Horizontally', 'x3p0-media-data'),
			3 => __('Rotated 180&deg;', 'x3p0-media-data'),
			4 => __('Mirrored Vertically', 'x3p0-media-data'),
			5 => __('Rotated 90&deg;, Mirrored Horizontally', 'x3p0-media-data'),
			6 => __('Rotated 90&deg;', 'x3p0-media-data'),
			7 => __('Rotated 270&deg;, Mirrored Horizontally', 'x3p0-media-data'),
			8 => __('Rotated 270&deg;', 'x3p0-media-data'),
			default => __('Normal', 'x3p0-media-data') // 1: orientation
		};

		return sprintf(
			'<div class="%s" property="value">%s</div>',
			$this->scopeClass('value'),
			esc_html($orientation)
		);
	}

	public function render(string $attrs, string $label = ''): string {
		if (! $this->hasValue()) {
			return '';
		}

		return sprintf(
			'<div %s property="exifData" typeof="PropertyValue">%s %s</div>',
			$attrs,
			$this->renderLabel($label),
			$this->renderValue()
		);
	}
}
