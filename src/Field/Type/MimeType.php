<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * MIME type field - displays the media MIME type.
 */
class MimeType extends Field
{
	public function label(): string
	{
		return __('Media Type', 'x3p0-media-data');
	}

	public function value(): mixed
	{
		$post = $this->context->post();

		if (! $post) {
			return null;
		}

		// Try to get from post first.
		if ($mime = get_post_mime_type($post)) {
			return $mime;
		}

		// Fall back to metadata.
		return $this->context->get('mime_type');
	}

	public function render(): string
	{
		$mimeType = $this->value();

		return $mimeType ? esc_html($mimeType) : '';
	}
}
