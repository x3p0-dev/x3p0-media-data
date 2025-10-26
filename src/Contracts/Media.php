<?php
declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

interface Media
{
	public function mediaId(): int;

	public function data(): array;

	public function has(string $key): bool;

	public function get(string $key): mixed;
}
