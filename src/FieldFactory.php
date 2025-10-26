<?php
/**
 * Field factory implementation.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */
declare(strict_types=1);

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\FieldFactory as FieldFactoryContract;
use X3P0\MediaData\Contracts\FieldTypeRegistry;
use X3P0\MediaData\Contracts\Media;
use X3P0\MediaData\Contracts\MediaField;

final class FieldFactory implements FieldFactoryContract
{
	public function __construct(
		private FieldTypeRegistry $registry
	) {}

	public function make(string $fieldKey, Media $media): ?MediaField
	{
		$fieldClass = $this->registry->get($fieldKey);

		if (!$fieldClass) {
			return null;
		}

		return new $fieldClass($media);
	}
}
