<?php

/**
 * Media data field block class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block\Type;

use WP_Block;
use WP_HTML_Tag_Processor;
use X3P0\MediaData\Block\Block;

/**
 * Renders the `x3p0/media-data-field` block on the front end.
 */
final class MediaData implements Block
{
	/**
	 * {@inheritdoc}
	 */
	public function render(array $attributes, string $content, WP_Block $block): string
	{
		$processor = new WP_HTML_Tag_Processor($content);

		if ($processor->next_tag(['class_name' => 'wp-block-x3p0-media-data'])) {
			$processor->set_attribute('vocab', 'https://schema.org/');
			$processor->set_attribute('typeof', 'MediaObject');
		}

		return $processor->get_updated_html();
	}
}
