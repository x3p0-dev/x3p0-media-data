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

use X3P0\MediaData\Attachment\{
	AttachmentFactory,
	AttachmentRepository,
	AttachmentService
};

use X3P0\MediaData\Contracts\{
	Bootable,
	Container,
	FieldTypeRegistry,
	MediaFactory,
	MediaRepository,
	MediaService
};

use X3P0\MediaData\Field\{FieldFactory, FieldTypeProvider, FieldTypes};

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
		$this->instance(FieldTypeRegistry::class, new FieldTypes());

		$this->instance(FieldFactory::class, new FieldFactory(
			registry: $this->get(FieldTypeRegistry::class)
		));

		$this->instance(MediaRepository::class, new AttachmentRepository());

		$this->instance(MediaFactory::class, new AttachmentFactory(
			fieldFactory: new FieldFactory($this->get(FieldTypeRegistry::class))
		));

		$this->instance(MediaService::class, new AttachmentService(
			repository: $this->get(MediaRepository::class),
			factory:    $this->get(MediaFactory::class)
		));

		$this->instance(Block\Register::class, new Block\Register(
			path: __DIR__ . '/../public/blocks'
		));

		// Register fields on `init` when translations are ready.
		add_action('init', function() {
			FieldTypeProvider::register($this->get(FieldTypeRegistry::class));
		}, PHP_INT_MIN);
	}
}
