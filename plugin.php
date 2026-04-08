<?php

/**
 * Plugin Name:       X3P0: Media Data
 * Plugin URI:        https://github.com/x3p0-dev/x3p0-media-data
 * Description:       Display media data via the block editor.
 * Version:           2.0.0
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

# Define the plugin constants.
const PLUGIN_DIR  = __DIR__;

# Load the autoloader.
if (! class_exists(Plugin::class) && is_file(PLUGIN_DIR . '/vendor/autoload.php')) {
	require_once PLUGIN_DIR . '/vendor/autoload.php';
}

# Initialize the plugin and boot registered services.
add_action('plugins_loaded', fn() => plugin()->boot(), -999);
