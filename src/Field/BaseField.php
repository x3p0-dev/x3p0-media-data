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

use X3P0\MediaData\Contracts\{Media, MediaField};

/**
 * Abstract field class, which serves as a helper between the contract and field
 * type subclasses by defining reasonable defaults for some methods.
 */
abstract class BaseField implements MediaField
{
	/**
	 * Creates a new field instance with the given context.
	 */
	public function __construct(protected Media $media)
	{}

	/**
	 * {@inheritDoc}
	 */
	public function hasValue(): bool
	{
		return ! empty($this->getValue());
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		return esc_html($this->getValue());
	}
}
