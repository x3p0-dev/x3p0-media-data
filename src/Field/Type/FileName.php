<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * File name field - displays the media file name.
 */
class FileName extends Field
{
	public function label(): string
	{
		return __('File Name', 'x3p0-media-data');
	}

	public function value(): mixed
	{
		$post = $this->context->post();

		if (! $post) {
			return null;
		}

		$file = get_attached_file($post->ID);

		return $file ? basename($file) : null;
	}

	public function render(): string
	{
		$filename = $this->value();

		return $filename ? esc_html($filename) : '';
	}
}
