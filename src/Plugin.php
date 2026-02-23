<?php

/**
 * Plugin application class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData;

use X3P0\MediaData\Framework\Core\Application;

/**
 * The Plugin class is an implementation of the Application contract. It's used
 * to register the default service providers, bootstrapping the plugin.
 */
final class Plugin extends Application
{
	/**
	 * Defines the plugin's namespace, which is used as a hook prefix.
	 */
	protected const NAMESPACE = 'x3p0/media-data';

	/**
	 * Defines the plugin's default service providers.
	 */
	protected const PROVIDERS = [
		Block\BlockServiceProvider::class,
		Field\FieldServiceProvider::class,
		Media\MediaServiceProvider::class
	];
}
