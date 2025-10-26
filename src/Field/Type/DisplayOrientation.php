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

use X3P0\MediaData\Field\BaseField;

/**
 * Displays the media's orientation (landscape, portrait, square).)
 */
class DisplayOrientation extends BaseField
{
	/**
	 * {@inheritDoc}
	 */
	public function renderLabel(): string
	{
		return esc_html__('Orientation', 'x3p0-media-data');
	}

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

		return match (true) {
			$width > $height => 'landscape',
			$height > $width => 'portrait',
			default          => 'square',
		};
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		if (! $value = $this->getValue()) {
			return '';
		}

		return match ($value) {
			'landscape' => __('Landscape', 'x3p0-media-data'),
			'portrait'  => __('Portrait', 'x3p0-media-data'),
			default     => __('Square', 'x3p0-media-data')
		};
	}
}
