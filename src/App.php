<?php

/**
 * Plugin container implementation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-ideas
 */

declare(strict_types=1);

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\{Bootable, Container};
use X3P0\MediaData\Field\FieldProvider;
use X3P0\MediaData\Field\FieldFactory;
use X3P0\MediaData\Field\FieldRegistry;
use X3P0\MediaData\Media\MediaRepository;

/**
 * The App class is a simple container used to store and reference the various
 * plugin components. It's also used to register the default bindings.
 */
class App implements Bootable, Container
{
	/**
	 * Stored definitions of single instances.
	 */
	private array $instances = [];

	/**
	 * Registers the default container bindings.
	 */
	public function __construct()
	{
		$this->registerDefaultBindings();
	}

	/**
	 * {@inheritdoc}
	 */
	#[\Override]
	public function boot(): void
	{
		foreach ($this->instances as $binding) {
			$binding instanceof Bootable && $binding->boot();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function instance(string $abstract, mixed $instance): void
	{
		$this->instances[$abstract] = $instance;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get(string $abstract): mixed
	{
		return $this->has($abstract) ? $this->instances[$abstract] : null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function has(string $abstract): bool
	{
		return isset($this->instances[$abstract]);
	}

	/**
	 * Registers the default bindings we need to run the Plugin.
	 */
	private function registerDefaultBindings(): void
	{
		$fieldRegistry = new FieldRegistry();

		$this->instance('media.repository', new MediaRepository(
			fieldFactory: new FieldFactory($fieldRegistry)
		));

		$this->instance('block.register', new Block\Register(
			path: __DIR__ . '/../public/blocks'
		));

		// Register fields on `init` when translations are ready.
		add_action('init', function() use ($fieldRegistry) {
			FieldProvider::register($fieldRegistry);
		}, PHP_INT_MIN);
	}
}
