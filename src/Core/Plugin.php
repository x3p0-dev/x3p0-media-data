<?php

/**
 * Plugin application implementation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-ideas
 */

declare(strict_types=1);

namespace X3P0\MediaData\Core;

use X3P0\MediaData\Contracts\Bootable;
use X3P0\MediaData\Block\BlockServiceProvider;
use X3P0\MediaData\Field\FieldServiceProvider;
use X3P0\MediaData\Media\MediaServiceProvider;

/**
 * The Plugin class is an implementation of the Application interface. It's used
 * to bootstrap the plugin and register the default service providers.
 */
final class Plugin implements Application
{
	/**
	 * Stores an array of the registered service providers.
	 */
	private array $providers = [];

	/**
	 * Registers the default service providers.
	 */
	public function __construct(protected Container $container)
	{
		$this->register(BlockServiceProvider::class);
		$this->register(FieldServiceProvider::class);
		$this->register(MediaServiceProvider::class);
	}

	/**
	 * {@inheritDoc}
	 */
	public function container(): Container
	{
		return $this->container;
	}

	/**
	 * {@inheritDoc}
	 */
	public function register(string|object $provider): void
	{
		if (! is_subclass_of($provider, ServiceProvider::class)) {
			return;
		}

		if (is_string($provider)) {
			$provider = new $provider($this->container);
		}

		$provider->register();
		$this->providers[] = $provider;
	}

	/**
	 * {@inheritdoc}
	 */
	public function boot(): void
	{
		foreach ($this->providers as $provider) {
			if ($provider instanceof Bootable) {
				$provider->boot();
			}
		}
	}
}
