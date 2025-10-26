<?php

/**
 * Field type registry interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Registry for mapping field type keys to their implementing classes. Allows
 * registration of custom field types.
 */
interface FieldTypeRegistry
{
	/**
	 * Registers a field type.
	 *
	 * @param class-string<Field> $className
	 */
	public function register(string $key, string $className): void;

	/**
	 * Determines if a field type is registered.
	 */
	public function isRegistered(string $key): bool;

	/**
	 * Returns the field type class name for a given key.
	 */
	public function get(string $key): ?string;

	/**
	 * Unregisters a field type for the given key.
	 */
	public function unregister(string $key): void;

	/**
	 * Returns all registered field type keys.
	 */
	public function keys(): array;

	/**
	 * Returns all registered field types.
	 */
	public function all(): array;
}
