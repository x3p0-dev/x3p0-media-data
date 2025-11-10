/**
 * Block insert on enter hook.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useDispatch } from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';
import { createBlock } from '@wordpress/blocks';

import { useBlockPosition } from './useBlockPosition';

/**
 * Inserts a new block when the enter key is pressed.
 * @param clientId
 * @param isSelected
 * @param blockName
 * @param excludeSelector
 */
export function useBlockInsertOnEnter(
	clientId,
	isSelected,
	blockName = 'x3p0/media-data-field',
	excludeSelector = '.wp-block-x3p0-media-data-field__label'
) {
	const { insertBlock, selectBlock } = useDispatch(blockEditorStore);
	const { parentClientId, blockIndex } = useBlockPosition(clientId);

	useEffect(() => {
		if (! isSelected) {
			return;
		}

		const handleKeyDown = (event) => {
			const isInsideExcluded = excludeSelector && event.target.closest(excludeSelector);

			if (event.key === 'Enter' && !isInsideExcluded) {
				event.preventDefault();

				const newBlock = createBlock(blockName);
				void insertBlock(newBlock, blockIndex + 1, parentClientId);
				void selectBlock(newBlock.clientId);
			}
		};

		document.addEventListener('keydown', handleKeyDown);
		return () => document.removeEventListener('keydown', handleKeyDown);
	}, [isSelected, blockIndex, parentClientId, insertBlock, selectBlock, blockName, excludeSelector]);
}
