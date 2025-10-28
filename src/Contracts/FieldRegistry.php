<?php

/**
 * Field Registry interface.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

/**
 * Field registry implementations are meant for storing a registry of field
 * classes so that they can later be instantiated as needed. This interface
 * doesn't have an `unregister()` method at the moment because it needs to pair
 * with the expectations of existing fields on the JS end, which are not
 * currently connected.
 */
interface FieldRegistry
{
	/**
	 * Registers a new field class.
	 *
	 * @param class-string $fieldClass
	 */
	public function register(string $key, string $fieldClass): void;

	/**
	 * Determines whether a field class exists in the registry.
	 */
	public function isRegistered(string $key): bool;

	/**
	 * Returns the field class or null.
	 *
	 * @return class-string|null
	 */
	public function get(string $key): ?string;
}
