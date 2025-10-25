<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Aperture field - displays camera aperture for images.
 */
class CreatedTimestamp extends Field
{
	public function label(): string
	{
		return __('Created Date', 'x3p0-media-data');
	}

	public function value(): mixed
	{
		return $this->context->get('created_timestamp');
	}

	public function render(): string
	{
		if (! $timestamp = $this->value()) {
			return '';
		}

		return esc_html(wp_date(
			get_option('date_format'),
			intval($timestamp)
		));
	}
}
