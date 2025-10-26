<?php

/**
 * Created Timestamp field class.
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
 * Displays the media's created timestamp, formatted.
 */
class CreatedTimestamp extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('Created', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function value(): mixed
	{
		return $this->context->get('created_timestamp');
	}

	/**
	 * {@inheritDoc}
	 */
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
