import { __ } from '@wordpress/i18n';
import { BlockControls, MediaReplaceFlow } from '@wordpress/block-editor';
import { MenuItem, ToolbarButton } from '@wordpress/components';

export default ({
	attributes,
	isSelected,
	mediaUrl,
	onSelectMedia,
	onRemoveMedia,
	onAddFieldBlock,
}) => {
	const { mediaId } = attributes;

	return (
		<BlockControls group="other">
			<MediaReplaceFlow
				mediaId={mediaId}
				mediaURL={mediaUrl}
				allowedTypes={['image', 'video', 'audio', 'application']}
				accept="*"
				onSelect={onSelectMedia}
				name={__('Replace', 'x3p0-media-data')}
				popoverProps={{ placement: 'bottom-start' }}
			>
				{mediaId && (
					<MenuItem onClick={onRemoveMedia}>
						{__('Reset', 'x3p0-media-data')}
					</MenuItem>
				)}
			</MediaReplaceFlow>
			{isSelected && (
				<ToolbarButton onClick={onAddFieldBlock}>
					{__('Add', 'x3p0-media-data')}
				</ToolbarButton>
			)}
		</BlockControls>
	);
};
