/**
 * Registers the Media Data block.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

// Import stylesheets.
import './scss/style.scss';

// Import dependencies.
import { registerBlockType } from '@wordpress/blocks';

// Import the block data and components.
import metadata from './block.json';
import edit     from './edit';
import save     from './save';
import icon     from './icon';

// Register the block type.
registerBlockType(metadata, { edit, save, icon });
