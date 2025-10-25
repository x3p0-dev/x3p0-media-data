<?php
/**
 * Renders the Media Meta Field block on the front end.
 */

namespace X3P0\MediaData;

use WP_Block;
use X3P0\MediaData\Block\MediaDataField;

/**
 * @global array    $attributes Block attributes.
 * @global WP_Block $block      Block instance.
 */
echo (new MediaDataField(
	mediaRepository: plugin()->get('media.repository'),
	attributes: $attributes,
	block: $block
))->render();
