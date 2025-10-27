import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { RawHTML } from '@wordpress/element';
import { Notice } from '@wordpress/components';
import { useBlockInsertOnEnter, useMediaField, useMediaFieldOptions } from '../hooks';
import {useSelect} from "@wordpress/data";
import {getBlockBindingsSource} from "@wordpress/blocks";

export default (props) => {
	const { attributes, setAttributes, context, clientId, isSelected } = props;
	const { field, label } = attributes;
	const mediaId = context['x3p0-media-data/mediaId'];
	const parentMetadata = context['x3p0-media-data/metadata'];

	useBlockInsertOnEnter(clientId, isSelected);

	const fieldOptions = useMediaFieldOptions();
	const { fieldValue, isResolving } = useMediaField(mediaId, field);

	const hasBoundMediaId = useSelect(
		( select ) => {
			const blockBindingsSource = getBlockBindingsSource(
				parentMetadata?.bindings?.mediaId?.source
			);

			return !! blockBindingsSource;
		},
		[ parentMetadata?.bindings?.mediaId ]
	);

	const currentField = fieldOptions.find((option) => option.value === field);
	const displayLabel = currentField?.label || __('Data', 'x3p0-media-data');
	const fieldClassName = field ? field.replace(/_/g, '-') : 'title';

	const blockProps = useBlockProps({
		className: `wp-block-x3p0-media-data-field--${fieldClassName}`,
	});

	const innerBlocksProps = useInnerBlocksProps(blockProps);

	if (! mediaId && ! hasBoundMediaId) {
		return (
			<div {...blockProps}>
				<Notice status="warning" isDismissible={false}>
					{__('No connected media ID.', 'x3p0-media-data')}
				</Notice>
			</div>
		);
	}

	const renderFieldContent = () => {
		if (isResolving) {
			return __('Loading…', 'x3p0-media-data');
		}

		if (fieldValue) {
			return <RawHTML>{fieldValue}</RawHTML>;
		}

		if (hasBoundMediaId) {
			return __('Connected to custom media source', 'x3p0-media-data');
		}

		return __('No data', 'x3p0-media-data');
	};

	return (
		<div {...innerBlocksProps}>
			<RichText
				tagName="div"
				className="wp-block-x3p0-media-data-field__label"
				value={label}
				onChange={(value) => setAttributes({ label: value })}
				placeholder={displayLabel}
			/>
			<div className="wp-block-x3p0-media-data-field__content">
				{renderFieldContent()}
			</div>
		</div>
	);
};
