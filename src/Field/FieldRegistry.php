<?php

/**
 * Field registry class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Contracts\Field;

/**
 * Registry for mapping field keys to their implementing classes and metadata.
 * Allows registration of custom fields and provides lookup functionality
 * without requiring class instantiation for metadata access.
 */
class FieldRegistry
{
	/**
	 * Stores field metadata and class mappings.
	 */
	private array $fields = [];

	/**
	 * Registers a field class with metadata for a given key.
	 *
	 * @param class-string<Field> $fieldClass
	 */
	public function register(string $key, string $fieldClass): void
	{
		$this->fields[$key] = $fieldClass;
	}

	public function isRegistered(string $key): bool
	{
		return isset($this->fields[$key]);
	}

	/**
	 * Gets the field class name for a given key.
	 */
	public function get(string $key): ?string
	{
		return $this->isRegistered($key) ? $this->fields[$key] : null;
	}

	/**
	 * Unregisters a field for the given key.
	 */
	public function unregister(string $key): void
	{
		unset($this->fields[$key]);
	}

	/**
	 * Gets all registered field keys.
	 */
	public function keys(): array
	{
		return array_keys($this->fields);
	}

	/**
	 * Gets all registered fields with full descriptors.
	 */
	public function all(): array
	{
		return $this->fields;
	}
}
