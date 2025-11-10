<?php

/**
 * Media data block class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block\Type;

use WP_Block;
use X3P0\MediaData\Block\Block;
use X3P0\MediaData\Field\FieldResolver;

/**
 * Renders the `x3p0/media-data` block on the front end.
 */
final class MediaData implements Block
{
	/**
	 * {@inheritdoc}
	 */
	public function render(array $attributes, string $content, WP_Block $block): string
	{
		return sprintf(
			'<div %s>%s</div>',
			get_block_wrapper_attributes(),
			$content
		);
	}
}
