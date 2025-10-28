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

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\FieldRegistry;

/**
 * Stores the field classes in a registry to later be instantiated.
 */
final class FieldTypes implements FieldRegistry
{
	/**
	 * Stores field type registrations: key => fully qualified class name.
	 *
	 * @var array<string, string>
	 */
	private array $types = [];

	/**
	 * {@inheritDoc}
	 */
	public function register(string $key, string $fieldClass): void
	{
		$this->types[$key] = $fieldClass;
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
		return $this->types[$key] ?? null;
	}
}
