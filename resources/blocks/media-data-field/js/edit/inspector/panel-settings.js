
// WordPress dependencies.
import { useInstanceId } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

import {
	__experimentalToolsPanel as ToolsPanel,
	__experimentalToolsPanelItem as ToolsPanelItem,
	SelectControl,
	TextControl
} from '@wordpress/components';
import {useMediaFieldOptions} from "../hooks";

// Exports the post taxonomy panel.
const SettingsPanel = ({
	attributes: {
		field,
		label
	},
	setAttributes
}) => {
	const panelId = useInstanceId(SettingsPanel);

	// Get display label
	const fieldOptions = useMediaFieldOptions();
	const currentField = fieldOptions.find((option) => option.value === field);
	const displayLabel = currentField?.label || __('Data', 'x3p0-media-data');

	return (
		<ToolsPanel
			label={__('Settings', 'x3p0-breadcrumbs')}
			resetAll={() => setAttributes({
				field: 'title',
				label: undefined
			})}
			panelId={panelId}
		>
			<ToolsPanelItem
				key="x3p0-media-data-panel-label"
				label={__('Field', 'x3p0-media-data')}
				hasValue={() => field !== 'title'}
				onDeselect={() => setAttributes({ field: 'title' })}
				panelId={panelId}
				isShownByDefault={true}
			>
				<SelectControl
					label={__('Field', 'x3p0-media-data')}
					value={field}
					options={fieldOptions}
					onChange={(value) => setAttributes({ field: value })}
					__nextHasNoMarginBottom
					__next40pxDefaultSize
				/>
			</ToolsPanelItem>
			<ToolsPanelItem
				key="x3p0-media-data-panel-field"
				label={__('Field', 'x3p0-media-data')}
				hasValue={() => field !== 'title'}
				onDeselect={() => setAttributes({ field: 'title' })}
				panelId={panelId}
				isShownByDefault={true}
			>
				<TextControl
					__next40pxDefaultSize
					__nextHasNoMarginBottom
					label={__('Label', 'x3p0-media-data')}
					placeholder={displayLabel}
					value={label}
					onChange={(value) => setAttributes({ label: value })}
				/>
			</ToolsPanelItem>
		</ToolsPanel>
	);
};

export default SettingsPanel;
