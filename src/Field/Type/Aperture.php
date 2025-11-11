<?php

/**
 * Aperture field class.
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
 * Displays an image aperture.
 */
final class Aperture extends AbstractField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		return $this->media->get('aperture');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Aperture', 'x3p0-media-data');
	}

	protected function renderLabel(string $label = ''): string
	{
		$label = $label ?: $this->getLabel();

		return sprintf(
			'<div class="%s"%s>%s</div>',
			$this->scopeClass('label'),
			'Aperture' === $label ? '  property="name"' : '',
			$label
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $aperture = $this->getValue()) {
			return '';
		}

		// Converts fraction formats (e.g., "28/10") to decimal. This
		// format may be stored with images from older versions of WP.
		if (is_string($aperture) && str_contains($aperture, '/')) {
			$parts = explode('/', $aperture);

			if (
				count($parts) === 2
				&& is_numeric($parts[0])
				&& is_numeric($parts[1])
				&& $parts[1] != 0
			) {
				$aperture = floatval($parts[0]) / floatval($parts[1]);
			}
		}

		// Convert to float if it's a numeric string
		if (is_string($aperture) && is_numeric($aperture)) {
			$aperture = floatval($aperture);
		}

		// Ensure we have a valid number
		if (! is_numeric($aperture) || $aperture <= 0) {
			return '';
		}

		// Format the aperture value by removing unnecessary decimal
		// places (e.g., 2.8 instead of 2.80)
		$aperture = rtrim(rtrim(number_format($aperture, 2, '.', ''), '0'), '.');


		return sprintf(
			'<div class="%s" property="value">%s</div>',
			$this->scopeClass('value'),
			sprintf('f/%s', esc_html($aperture))
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
