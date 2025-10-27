<?php

/**
 * Block Bindings class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block;

use WP_Block;
use X3P0\MediaData\Contracts\Bootable;

class Bindings implements Bootable
{
	/**
	 * {@inheritdoc}
	 */
	public function boot(): void
	{
		add_filter(
			'block_bindings_supported_attributes_x3p0/media-data',
			[$this, 'addBindableAttributes']
		);

		add_filter('render_block_context', [$this, 'addBlockContext'], 10, 3);
	}

	/**
	 * Add attributes to the `x3p0/media-data` block that support block
	 * being connected to a Block Bindings source.
	 */
	public function addBindableAttributes(array $attrs): array
	{
		$attrs[] = 'mediaId';

		return $attrs;
	}

	/**
	 * Adds the `x3p0-media-data/mediaId` context to the Media Data Field
	 * block when the parent doesn't pass the context along. This seems to
	 * happen when the `mediaId` attribute is tied to a block binding.
	 */
	public function addBlockContext(
		array $context,
		array $block,
		?WP_Block $parent
	): array {
		if (
			$block['blockName'] === 'x3p0/media-data-field'
			&& 0 === $context['x3p0-media-data/mediaId']
			&& $parent instanceof WP_Block
			&& $parent->name === 'x3p0/media-data'
			&& isset($parent->attributes['mediaId'])
		) {
			$context['x3p0-media-data/mediaId'] = $parent->attributes['mediaId'];
		}

		return $context;
	}
}
