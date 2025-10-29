<?php

/**
 * Dimensions field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\BaseField;

/**
 * Displays the media width and height.
 */
final class Dimensions extends BaseField
{
	/**
	 * {@inheritDoc}
	 */
	public function hasValue(): bool
	{
		['width' => $width, 'height' => $height] = $this->getValue();
		return $width && $height;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getValue(): array
	{
		return [
			'width'  => $this->media->get('width') ?: null,
			'height' => $this->media->get('height') ?: null
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		['width' => $width, 'height' => $height] = $this->getValue();

		if (! $width || ! $height) {
			return '';
		}

		return esc_html(sprintf(
			// Translators: Media dimensions - 1 is width and 2 is height.
			__('%1$s &#215; %2$s', 'x3p0-media-data'),
			number_format_i18n($width),
			number_format_i18n($height)
		));
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Dimensions', 'x3p0-media-data');
	}
}
