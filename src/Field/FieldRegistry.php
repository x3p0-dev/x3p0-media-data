<?php

/**
 * Field type registry class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use TypeError;
use X3P0\MediaData\Contracts\Field;

/**
 * Registry for mapping field type keys to their implementing classes. Allows
 * registration of custom field types.
 */
class FieldRegistry
{
	/**
	 * Stores field metadata and class mappings.
	 */
	private array $fields = [];

	/**
	 * Registers a field type.
	 *
	 * @param class-string<Field> $className
	 */
	public function register(string $key, string $className): void
	{
		if (! is_subclass_of($className, Field::class)) {
			throw new TypeError(esc_html(sprintf(
				// Translators: %s is a PHP class name.
				__('Only %s classes can be registered', 'x3p0-media-data'),
				Field::class
			)));
		}

		$this->fields[$key] = $className;
	}

	/**
	 * Determines if a field type is registered.
	 */
	public function isRegistered(string $key): bool
	{
		return isset($this->fields[$key]);
	}

	/**
	 * Returns the field type class name for a given key.
	 */
	public function get(string $key): ?string
	{
		return $this->isRegistered($key) ? $this->fields[$key] : null;
	}

	/**
	 * Unregisters a field type for the given key.
	 */
	public function unregister(string $key): void
	{
		unset($this->fields[$key]);
	}

	/**
	 * Returns all registered field type keys.
	 */
	public function keys(): array
	{
		return array_keys($this->fields);
	}

	/**
	 * Returns all registered field types.
	 */
	public function all(): array
	{
		return $this->fields;
	}
}
