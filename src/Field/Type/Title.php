<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\Field;

/**
 * Aperture field - displays camera aperture for images.
 */
class Title extends Field
{
	public function value(): string
	{
		$post_id = $this->context->postId();

		return $post_id ? get_the_title($post_id) : '';
	}

	public function render(): string
	{
		$value = $this->value();

		return $value ? wp_strip_all_tags($value) : '';
	}

	public function label(): string
	{
		return __('Title', 'x3p0-media-data');
	}
}
