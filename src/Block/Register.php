<?php

/**
 * Block registration class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block;

use X3P0\MediaData\Contracts\Bootable;
use X3P0\MediaData\Field\FieldRegistry;

class Register implements Bootable
{
	/**
	 * Sets the path where the built blocks are stored.
	 */
	public function __construct(protected string $path)
	{}

	/**
	 * {@inheritdoc}
	 */
	public function boot(): void
	{
		add_action('init', [$this, 'register']);
	//	add_filter('block_type_metadata', [$this, 'setMetadata']);
	}

	/**
	 * Registers the block with WordPress.
	 */
	public function register(): void
	{
		wp_register_block_types_from_metadata_collection(
			$this->path,
			"{$this->path}/manifest.php"
		);
	}

	/**
	 * Adds a context provider to the `core/media-text` block to provide its
	 * `mediaId` attribute so that we can use it in our blocks.
	 */
	public function setMetadata(array $metadata): array
	{
		if ('core/media-text' !== $metadata['name']) {
			return $metadata;
		}

		$metadata['providesContext'] ??= [];
		$metadata['providesContext']['x3p0/mediaId'] = 'mediaId';

		return $metadata;
	}
}
