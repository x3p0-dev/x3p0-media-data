<?php

/**
 * Display Orientation field class.
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
 * Displays the media's orientation (landscape, portrait, square).)
 */
final class DisplayOrientation extends AbstractField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): ?string
	{
		$width  = $this->media->get('width');
		$height = $this->media->get('height');

		if (! $width || ! $height) {
			return null;
		}

		return $width > $height
			? 'landscape'
			: ($height > $width ? 'portrait' : 'square');
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
			'<div class="%s">%s</div>',
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
			'landscape' => __('Landscape', 'x3p0-media-data'),
			'portrait'  => __('Portrait', 'x3p0-media-data'),
			default     => __('Square', 'x3p0-media-data')
		};

		return sprintf(
			'<div class="%s">%s</div>',
			$this->scopeClass('value'),
			esc_html($orientation)
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
