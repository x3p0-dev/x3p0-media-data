import { __ } from '@wordpress/i18n';
import { BlockControls, MediaReplaceFlow } from '@wordpress/block-editor';
import { MenuItem } from '@wordpress/components';

export default ({
	attributes,
	mediaUrl,
	onSelectMedia,
	onRemoveMedia
}) => (
	<BlockControls group="other">
		<MediaReplaceFlow
			mediaId={attributes.mediaId}
			mediaURL={mediaUrl}
			allowedTypes={['image', 'video', 'audio', 'application']}
			accept="*"
			onSelect={onSelectMedia}
			name={__('Replace', 'x3p0-media-data')}
			popoverProps={{ placement: 'bottom-start' }}
		>
			{attributes.mediaId && (
				<MenuItem onClick={onRemoveMedia}>
					{__('Reset', 'x3p0-media-data')}
				</MenuItem>
			)}
		</MediaReplaceFlow>
	</BlockControls>
);
