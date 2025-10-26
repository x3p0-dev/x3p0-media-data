<?php

/**
 * Title field class.
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
 * Displays the image camera title.
 */
class Title extends Field
{
	/**
	 * {@inheritDoc}
	 */
	public function value(): string
	{
		$post_id = $this->context->postId();

		return $post_id ? get_the_title($post_id) : '';
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		$value = $this->value();

		return $value ? wp_strip_all_tags($value) : '';
	}

	/**
	 * {@inheritDoc}
	 */
	public function label(): string
	{
		return __('Title', 'x3p0-media-data');
	}
}
