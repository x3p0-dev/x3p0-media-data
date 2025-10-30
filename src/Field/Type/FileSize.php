<?php

/**
 * File Size field class.
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
 * Displays the media file size.
 */
final class FileSize extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): ?int
	{
		// Try to get filesize from metadata first.
		if ($filesize = $this->media->get('filesize')) {
			return absint($filesize);
		}

		// Fall back to checking the actual file.
		$file = get_attached_file($this->media->id());

		// Note that `filesize()` can return an integer or false.
		if (file_exists($file) && $size = filesize($file)) {
			return absint($size);
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $filesize = $this->getValue()) {
			return '';
		}

		// Note that `size_format()` can return a string or false.
		$size = size_format(absint($filesize), 2);

		return $size ? esc_html($size) : '';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('File Size', 'x3p0-media-data');
	}
}
