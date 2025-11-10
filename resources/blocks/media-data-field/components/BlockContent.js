/**
 * Block content.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import {
	useBlockInsertOnEnter,
	useHasBoundMediaId,
	useMediaField,
	useMediaFieldOptions
} from '../hooks';

import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { Notice }  from '@wordpress/components';
import { RawHTML } from '@wordpress/element';
import { __ }      from '@wordpress/i18n';

/**
 * Media ID context key.
 * @type {string}
 */
const MEDIA_ID_CONTEXT = 'x3p0-media-data/mediaId';

/**
 * Metadata context key.
 * @type {string}
 */
const METADATA_CONTEXT = 'x3p0-media-data/metadata';

/**
 * Returns the block content.
 * @param props
 * @returns {JSX.Element}
 */
const BlockContent = (props) => {
	const { attributes, setAttributes, context, clientId, isSelected } = props;
	const { field, label } = attributes;

	const mediaId        = context[MEDIA_ID_CONTEXT];
	const parentMetadata = context[METADATA_CONTEXT];

	const hasBoundMediaId             = useHasBoundMediaId(parentMetadata);
	const fieldOptions                = useMediaFieldOptions();
	const { fieldValue, isResolving } = useMediaField(mediaId, field);

	useBlockInsertOnEnter(clientId, isSelected);

	const blockProps = useBlockProps({
		className: `wp-block-x3p0-media-data-field--${
			field ? field.replace(/_/g, '-') : 'title'
		}`
	});

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
		<div {...useInnerBlocksProps(blockProps)}>
			<RichText
				tagName="div"
				className="wp-block-x3p0-media-data-field__label"
				value={label}
				onChange={(value) => setAttributes({ label: value })}
				placeholder={
					fieldOptions.find((option) => option.value === field)?.label
					|| __('Data', 'x3p0-media-data')
				}
			/>
			<div className="wp-block-x3p0-media-data-field__value">
				{renderFieldContent()}
			</div>
		</div>
	);
};

export default BlockContent;
