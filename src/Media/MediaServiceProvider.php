<?php

/**
 * Media service provider.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types = 1);

namespace X3P0\MediaData\Media;

use X3P0\MediaData\Core\ServiceProvider;

final class MediaServiceProvider extends ServiceProvider
{
	/**
	 * {@inheritDoc}
	 */
	public function register(): void
	{
		$this->container->singleton(MediaRepository::class, AttachmentRepository::class);
	}
}
