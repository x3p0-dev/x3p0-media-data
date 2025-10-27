
import { useDispatch, useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { store as blocksStore } from '@wordpress/blocks';
import { store as blockEditorStore } from '@wordpress/block-editor';

import { useEffect } from '@wordpress/element';
import { createBlock } from '@wordpress/blocks';

import { getMediaField } from '../../media-data';

export function useMediaField(mediaId, field) {
	return useSelect(
		(select) => {
			if (!mediaId) {
				return { media: null, fieldValue: null, isResolving: false };
			}

			// WordPress caches this - no refetch even if called in multiple components
			const media = select(coreStore).getEntityRecord('postType', 'attachment', mediaId);

			return {
				media,
				fieldValue: getMediaField(media, field),
				isResolving: !select(coreStore).hasFinishedResolution('getEntityRecord', [
					'postType',
					'attachment',
					mediaId,
				]),
			};
		},
		[mediaId, field]
	);
}

export function useMediaFieldOptions() {
	return useSelect((select) => {
		const variations = select(blocksStore).getBlockVariations('x3p0/media-data-field');

		if (!variations) {
			return [];
		}

		return variations
			.map((item) => ({
				value: item.attributes.field,
				label: item.title,
			}))
			.sort((a, b) => a.label.localeCompare(b.label));
	}, []);
}

export function useBlockPosition(clientId) {
	return useSelect(
		(select) => {
			const { getBlockParents, getBlockIndex } = select(blockEditorStore);
			const parents = getBlockParents(clientId);

			return {
				parentClientId: parents[parents.length - 1],
				blockIndex: getBlockIndex(clientId),
			};
		},
		[clientId]
	);
}

export function useBlockInsertOnEnter(clientId, isSelected, blockName = 'x3p0/media-data-field', excludeSelector = '.wp-block-x3p0-media-data-field__label') {
	const { insertBlock, selectBlock } = useDispatch(blockEditorStore);
	const { parentClientId, blockIndex } = useBlockPosition(clientId);

	useEffect(() => {
		if (!isSelected) {
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
