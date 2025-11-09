/**
 * Block save.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {useBlockProps, useInnerBlocksProps} from "@wordpress/block-editor";

/**
 * Saves the block and inner blocks content.
 * @returns {JSX.Element}
 */
export default () => (
	<div {...useInnerBlocksProps.save(useBlockProps.save())}/>
);
