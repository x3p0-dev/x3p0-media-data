<?php
declare(strict_types=1);

namespace X3P0\MediaData\Contracts;

interface FieldFactory
{
	public function make(string $fieldKey, Media $media): ?MediaField;
}
