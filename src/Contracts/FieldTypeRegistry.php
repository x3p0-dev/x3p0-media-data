<?php
declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

interface FieldTypeRegistry
{
	public function register(string $key, string $fieldClass): void;

	public function isRegistered(string $key): bool;

	public function get(string $key): ?string;
}
