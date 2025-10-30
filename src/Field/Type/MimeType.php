<?php

/**
 * MIME Type field class.
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
 * Displays the media MIME type.
 */
final class MimeType extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		// Try to get from post first.
		if ($mime = get_post_mime_type($this->media->id())) {
			return $mime;
		}

		// Fall back to metadata.
		return $this->media->get('mime_type');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('MIME Type', 'x3p0-media-data');
	}
}
