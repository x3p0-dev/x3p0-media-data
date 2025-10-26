<?php
/**
 * Renders the Media Meta Field block on the front end.
 */

namespace X3P0\MediaData;

use WP_Block;
use X3P0\MediaData\Block\MediaDataField;
use X3P0\MediaData\Contracts\MediaService;

/**
 * @global array    $attributes Block attributes.
 * @global WP_Block $block      Block instance.
 */
echo (new MediaDataField(
	mediaService: plugin()->get(MediaService::class),
	attributes: $attributes,
	block: $block
))->render();
