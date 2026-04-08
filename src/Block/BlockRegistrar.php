<?php

/**
 * Block registration class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025-2026, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block;

use X3P0\MediaData\Framework\Contracts\Bootable;
use const X3P0\MediaData\PLUGIN_DIR;

/**
 * Registers the plugin's block types with WordPress.
 */
final class BlockRegistrar implements Bootable
{
	/**
	 * Path to the blocks folder for the plugin.
	 */
	private const BLOCKS_DIR = PLUGIN_DIR . '/public/blocks';

	/**
	 * Filename of the blocks manifest.
	 */
	private const MANIFEST_FILENAME = 'blocks-manifest.php';

	/**
	 * {@inheritdoc}
	 */
	public function boot(): void
	{
		add_action('init', $this->register(...));
	}

	/**
	 * Registers the block with WordPress.
	 */
	public function register(): void
	{
		wp_register_block_types_from_metadata_collection(
			self::BLOCKS_DIR,
			self::BLOCKS_DIR . '/' . self::MANIFEST_FILENAME
		);
	}
}
