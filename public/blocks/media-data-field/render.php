<?php
/**
 * Renders the Media Meta Field block on the front end.
 */

namespace X3P0\MediaData;

use WP_Block;
use X3P0\MediaData\Block\Type\MediaDataField;

/**
 * @global array    $attributes Block attributes.
 * @global WP_Block $block      Block instance.
 */
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo container()->get(MediaDataField::class, [
	'attributes' => $attributes,
	'block'      => $block
])->render();
// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
