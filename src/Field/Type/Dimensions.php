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

use X3P0\MediaData\Field\Field;

/**
 * Displays the media width and height.
 */
class Dimensions extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('Dimensions', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function exists(): bool
	{
		$value = $this->value();
		return ! empty($value['width']) && ! empty($value['height']);
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): array
	{
		return [
			'width'  => $this->context->get('width'),
			'height' => $this->context->get('height')
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		$value = $this->value();
		$width  = absint($value['width']);
		$height = absint($value['height']);

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
}
