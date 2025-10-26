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
class FileSize extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('File Size', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): mixed
	{
		// Try to get filesize from metadata first.
		if ($filesize = $this->context->get('filesize')) {
			return $filesize;
		}

		// Fall back to checking the actual file.
		$post = $this->context->post();
		if (! $post) {
			return null;
		}

		$file = get_attached_file($post->ID);

		if (file_exists($file)) {
			return filesize($file);
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		$filesize = $this->value();

		if (! $filesize) {
			return '';
		}

		// Note that `size_format()` can return a string or false.
		$size = size_format(absint($filesize), 2);

		return $size ? esc_html($size) : '';
	}
}
