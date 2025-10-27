import { BlockControls, MediaReplaceFlow, store as blockEditorStore } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { MenuItem } from '@wordpress/components';
import { useDispatch } from '@wordpress/data';
import { useBlockPosition, useMediaField } from '../hooks';

export default (props) => {
	const { clientId, context, attributes } = props;
	const { field } = attributes;
	const mediaId = context['x3p0/mediaId'];
	const { media } = useMediaField(mediaId, field);
	const { parentClientId } = useBlockPosition(clientId);
	const { updateBlockAttributes } = useDispatch(blockEditorStore);

	const onSelectMedia = (selectedMedia) => {
		if (parentClientId) {
			updateBlockAttributes(parentClientId, {
				mediaId: selectedMedia.id
			});
		}
	};

	const onRemoveMedia = () => {
		if (parentClientId) {
			updateBlockAttributes(parentClientId, {
				mediaId: 0
			});
		}
	};

	return (
		<BlockControls group="other">
			<MediaReplaceFlow
				mediaId={mediaId}
				mediaURL={media?.source_url}
				accept="*"
				onSelect={onSelectMedia}
				name={__('Replace', 'x3p0-media-data')}
				popoverProps={{ placement: 'bottom-start' }}
			>
				<MenuItem onClick={onRemoveMedia}>
					{__('Reset', 'x3p0-media-data')}
				</MenuItem>
			</MediaReplaceFlow>
		</BlockControls>
	);
};
