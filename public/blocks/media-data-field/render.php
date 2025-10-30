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
echo plugin()->container()->make(MediaDataField::class, [
	'attributes' => $attributes,
	'block'      => $block
])->render();
