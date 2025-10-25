<?php

declare(strict_types=1);

namespace X3P0\MediaData\Field;

use X3P0\MediaData\Contracts;
use X3P0\MediaData\Media\MediaContext;

abstract class Field implements Contracts\Field
{
	public function __construct(protected MediaContext $context)
	{}

	public function value(): mixed {
		return $this->context->get($this->key);
	}

	public function exists(): bool
	{
		return ! empty($this->value());
	}

	public function render(): string
	{
		return esc_html($this->value());
	}
}
