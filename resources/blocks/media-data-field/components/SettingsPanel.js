/**
 * Settings panel.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

import { useMediaFieldOptions } from '../hooks';

import { useInstanceId } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';
import {
	__experimentalToolsPanel as ToolsPanel,
	__experimentalToolsPanelItem as ToolsPanelItem,
	SelectControl,
	TextControl
} from '@wordpress/components';

/**
 * Renders the block settings panel.
 * @param props
 * @returns {JSX.Element}
 */
const SettingsPanel = ({
	attributes: {
		field,
		label
	},
	setAttributes
}) => {
	const panelId      = useInstanceId(SettingsPanel);
	const fieldOptions = useMediaFieldOptions();

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
				key="x3p0-media-data-panel-field"
				label={__('Field', 'x3p0-media-data')}
				hasValue={() => field !== 'title'}
				onDeselect={() => setAttributes({ field: 'title' })}
				panelId={panelId}
				isShownByDefault
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
				key="x3p0-media-data-panel-label"
				label={__('Label', 'x3p0-media-data')}
				hasValue={() => field !== 'title'}
				onDeselect={() => setAttributes({ field: 'title' })}
				panelId={panelId}
				isShownByDefault
			>
				<TextControl
					label={__('Label', 'x3p0-media-data')}
					placeholder={
						fieldOptions.find((option) => option.value === field)?.label
						|| __('Data', 'x3p0-media-data')
					}
					value={label}
					onChange={(value) => setAttributes({ label: value })}
					__next40pxDefaultSize
					__nextHasNoMarginBottom
				/>
			</ToolsPanelItem>
		</ToolsPanel>
	);
};

export default SettingsPanel;
