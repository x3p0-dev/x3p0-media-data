
import './scss/style.scss';

import { registerBlockType } from '@wordpress/blocks';

import metadata from './block.json';
import edit     from './js/edit';
import save     from './js/save';

registerBlockType(metadata, {
	edit,
	save,
	// https://fonts.google.com/icons?icon.query=media+lib&icon.size=24&icon.color=%235f6368&icon.set=Material+Symbols&selected=Material+Symbols+Outlined:perm_media:FILL@0;wght@400;GRAD@0;opsz@24
	icon: (
		<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M360-440h400L622-620l-92 120-62-80-108 140ZM120-120q-33 0-56.5-23.5T40-200v-520h80v520h680v80H120Zm160-160q-33 0-56.5-23.5T200-360v-440q0-33 23.5-56.5T280-880h200l80 80h280q33 0 56.5 23.5T920-720v360q0 33-23.5 56.5T840-280H280Zm0-80h560v-360H527l-80-80H280v440Zm0 0v-440 440Z"/></svg>
	)
});
