<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * File size field - displays media file size.
 */
class FileSize extends Field
{
	public function label(): string
	{
		return __('File Size', 'x3p0-media-data');
	}

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
