<?php

/**
 * Block service provider.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-ideas
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block;

use X3P0\MediaData\Block\Type\MediaDataField;
use X3P0\MediaData\Contracts\Bootable;
use X3P0\MediaData\Core\ServiceProvider;

final class BlockServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * Stores the path to the plugin's blocks directory.
	 */
	private const BLOCKS_PATH = __DIR__ . '/../../public/blocks';

	/**
	 * {@inheritDoc}
	 */
	public function register(): void
	{
		$this->container->singleton(BlockRegistrar::class);
		$this->container->singleton(BlockBindingsSupport::class);
		$this->container->singleton(MediaDataField::class);
	}

	/**
	 * {@inheritDoc}
	 */
	public function boot(): void
	{
		$this->container->get(BlockRegistrar::class, [
			'path' => self::BLOCKS_PATH
		])->boot();

		$this->container->get(BlockBindingsSupport::class)->boot();
	}
}
