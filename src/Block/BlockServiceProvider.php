<?php

/**
 * Block service provider.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-ideas
 */

namespace X3P0\MediaData\Block;

use X3P0\MediaData\Contracts\Bootable;
use X3P0\MediaData\Core\ServiceProvider;
use X3P0\MediaData\Block;

final class BlockServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * {@inheritDoc}
	 */
	public function register(): void
	{
		$this->container->singleton(Block\BlockRegistrar::class);
		$this->container->singleton(Block\BlockBindingsSupport::class);
	}

	/**
	 * {@inheritDoc}
	 */
	public function boot(): void
	{
		$this->container->get(Block\BlockRegistrar::class, [
			'path' => __DIR__ . '/../../public/blocks'
		])->boot();

		$this->container->get(Block\BlockBindingsSupport::class)->boot();
	}
}
