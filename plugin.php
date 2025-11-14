<?php

/**
 * Plugin Name:       X3P0: Media Data
 * Plugin URI:        https://github.com/x3p0-dev/x3p0-media-data
 * Description:       Display media data via the block editor.
 * Version:           1.0.0
 * Requires at least: 6.8
 * Requires PHP:      8.1
 * Author:            Justin Tadlock
 * Author URI:        https://justintadlock.com
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData;

# Prevent direct access.
defined('ABSPATH') || exit;

# Load the autoloader.
if (is_file(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

# Initialize the plugin.
add_action('plugins_loaded', plugin(...), 9999);

# Boot registered services.
add_action('plugins_loaded', fn() => plugin()->boot(), PHP_INT_MAX);
