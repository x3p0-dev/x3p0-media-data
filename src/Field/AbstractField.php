<?php

/**
 * Abstract field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Media\Media;

/**
 * Abstract field class, which serves as a helper between the contract and field
 * subclasses by defining reasonable defaults for some methods.
 */
abstract class AbstractField implements Field
{
	protected const NAMESPACE = 'wp-block-x3p0-media-data-field';

	/**
	 * Creates a new field instance with the given media object.
	 */
	final public function __construct(protected readonly Media $media)
	{}

	/**
	 * Checks if the field has a value for the current media.
	 */
	public function hasValue(): bool
	{
		return ! empty($this->getValue());
	}

	/**
	 * Returns the escaped and formatted field value as a string.
	 */
	public function renderValue(): string
	{
		$value = $this->getValue();

		return $value ? esc_html(strval($value)) : '';
	}

	protected function renderLabel(string $label = ''): string
	{
		return sprintf(
			'<div class="%s">%s</div>',
			$this->scopeClass('label'),
			$label ?: $this->getLabel()
		);
	}

	/**
	 * Helper method for prefixing classes with the namespace.
	 */
	protected function scopeClass(string|array $class): string
	{
		$namespace = self::NAMESPACE;

		return implode(' ', array_map(
			fn($className) => "{$namespace}__{$className}",
			(array) $class
		));
	}
}
