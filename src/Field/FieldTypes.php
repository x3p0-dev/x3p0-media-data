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
use X3P0\MediaData\Contracts\{Field, FieldTypeRegistry};

/**
 * Registry for mapping field type keys to their implementing classes. Allows
 * registration of custom field types.
 */
class FieldTypes implements FieldTypeRegistry
{
	/**
	 * Stores field type class names, indexed by key.
	 */
	private array $types = [];

	/**
	 * {@inheritDoc}
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

		$this->types[$key] = $className;
	}

	/**
	 * {@inheritDoc}
	 */
	public function isRegistered(string $key): bool
	{
		return isset($this->types[$key]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function get(string $key): ?string
	{
		return $this->isRegistered($key) ? $this->types[$key] : null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function unregister(string $key): void
	{
		unset($this->types[$key]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function keys(): array
	{
		return array_keys($this->types);
	}

	/**
	 * {@inheritDoc}
	 */
	public function all(): array
	{
		return $this->types;
	}
}
