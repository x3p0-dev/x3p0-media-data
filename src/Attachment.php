<?php
/**
 * Immutable media value object.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */
declare(strict_types=1);

namespace X3P0\MediaData;

use X3P0\MediaData\Contracts\Media;

class Attachment implements Media
{
	public function __construct(
		private int $mediaId,
		private array $data
	) {}

	public function mediaId(): int
	{
		return $this->mediaId;
	}

	public function data(): array
	{
		return $this->data;
	}

	public function has(string $key): bool
	{
		return $this->get($key) !== null;
		//return array_key_exists($key, $this->data);
	}

	public function get(string $key): mixed
	{
		return $this->data[$key]
			?? $this->data['image_meta'][$key]
			?? $this->data['audio'][$key]
			?? null;
		//return $this->data[$key] ?? null;
	}
}
