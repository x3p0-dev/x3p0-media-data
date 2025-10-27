
import { InspectorControls } from '@wordpress/block-editor';
import SettingsPanel from "./panel-settings";

export default (props) => (
	<InspectorControls group="settings">
		<SettingsPanel {...props}/>
	</InspectorControls>
);
