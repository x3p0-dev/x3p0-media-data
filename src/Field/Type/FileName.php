<?php

/**
 * File Name field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\AbstractField;

/**
 * Displays the media filename.
 */
final class FileName extends AbstractField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): ?string
	{
		$file = get_attached_file($this->media->id());

		return $file ? basename($file) : null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('File Name', 'x3p0-media-data');
	}
}
