<?php
declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

interface MediaField
{
	/**
	 * Checks if the field has a value for the current media.
	 */
	public function exists(): bool;

	/**
	 * Returns the raw, unformatted value of the field.
	 */
	public function getValue(): mixed;

	/**
	 * Returns the escaped and formatted field value as a string.
	 */
	public function render(): string;

	/**
	 * Returns the escaped and internationalized field label.
	 */
	public function renderLabel(): string;
}
