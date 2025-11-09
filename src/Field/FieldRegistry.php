<?php

/**
 * Field registry implementation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use TypeError;
use X3P0\MediaData\Contracts\ClassRegistry;

/**
 * Stores the field classes in a registry to later be instantiated.
 */
final class FieldRegistry implements ClassRegistry
{
	/**
	 * Stores field type registrations: key => fully qualified class name.
	 *
	 * @var array<string, string>
	 */
	private array $fields = [];

	/**
	 * Add a field class.
	 *
	 * @param class-string<Field> $className
	 */
	public function register(string $key, string $className): void
	{
		if (! is_subclass_of($className, Field::class)) {
			throw new TypeError(esc_html(sprintf(
				// Translators: %s is a PHP class name.
				__('Only %s classes can be registered', 'x3p0-breadcrumbs'),
				Field::class
			)));
		}

		$this->fields[$key] = $className;
	}

	/**
	 * Removes a field class.
	 */
	public function unregister(string $key): void
	{
		unset($this->fields[$key]);
	}

	/**
	 * Checks if a field class is registered.
	 */
	public function isRegistered(string $key): bool
	{
		return isset($this->fields[$key]);
	}

	/**
	 * Returns a crumb type.
	 *
	 * @return null|class-string<Field>
	 */
	public function get(string $key): ?string
	{
		return $this->isRegistered($key) ? $this->fields[$key] : null;
	}
}
