<?php

/**
 * File Name field class.
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
 * Displays the media filename.
 */
class FileName extends BaseField
{
	/**
	 * {@inheritDoc}
	 */
	public function renderLabel(): string
	{
		return esc_html__('File Name', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): mixed
	{
		$mediaId = $this->context->mediaId();

		if (! $mediaId) {
			return null;
		}

		$file = get_attached_file($mediaId);

		return $file ? basename($file) : null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		$filename = $this->value();

		return $filename ? esc_html($filename) : '';
	}
}
