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

use X3P0\MediaData\Field\AbstractField;

/**
 * Displays the media MIME type.
 */
final class MimeType extends AbstractField
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

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		return sprintf(
			'<div class="%s" property="encodingFormat">%s</div>',
			$this->scopeClass('value'),
			wp_strip_all_tags($this->getValue())
		);
	}

	public function render(string $attrs, string $label = ''): string {
		if (! $this->hasValue()) {
			return '';
		}

		return sprintf(
			'<div %s>%s %s</div>',
			$attrs,
			$this->renderLabel($label),
			$this->renderValue()
		);
	}
}
