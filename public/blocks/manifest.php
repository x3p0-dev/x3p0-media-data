<?php
// This file is generated. Do not modify it manually.
return array(
	'media-data' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'x3p0/media-data',
		'version' => '1.0.0',
		'title' => 'Media Data',
		'category' => 'media',
		'icon' => 'info-outline',
		'description' => 'Display data for media attachments.',
		'keywords' => array(
			'media',
			'metadata',
			'attachment',
			'exif'
		),
		'textdomain' => 'x3p0-media-data',
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'__experimentalStyle' => array(
				'css' => '&.is-layout-flex { gap: var(--wp--custom--x-3-p-0-media-data--gap, 0.5rem); }',
				'spacing' => array(
					'blockGap' => 'var(--wp--custom--x-3-p-0-media-meta--gap, 0.5rem)'
				)
			),
			'layout' => array(
				'allowCustomContentAndWideSize' => false,
				'allowEditing' => false,
				'allowInheriting' => false,
				'allowJustification' => true,
				'allowOrientation' => false,
				'allowSizingOnChildren' => false,
				'allowSwitching' => true,
				'allowVerticalAlignment' => true,
				'default' => array(
					'type' => 'constrained'
				)
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'blockGap' => true
			),
			'color' => array(
				'text' => true,
				'background' => true,
				'link' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			)
		),
		'providesContext' => array(
			'x3p0/mediaId' => 'mediaId'
		),
		'usesContext' => array(
			'postId',
			'postType'
		),
		'attributes' => array(
			'mediaId' => array(
				'type' => 'number',
				'default' => 0
			)
		),
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css'
	),
	'media-data-field' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'x3p0/media-data-field',
		'version' => '1.0.0',
		'title' => 'Media Data Field',
		'category' => 'media',
		'icon' => 'tag',
		'description' => 'Display a single data field for media.',
		'keywords' => array(
			'media',
			'metadata',
			'field',
			'meta'
		),
		'parent' => array(
			'x3p0/media-data'
		),
		'textdomain' => 'x3p0-media-data',
		'supports' => array(
			'html' => false,
			'__experimentalStyle' => array(
				'css' => '&.is-layout-flex { gap: var(--wp--custom--x-3-p-0-media-data--gap, 0.5rem); }',
				'spacing' => array(
					'blockGap' => 'var(--wp--custom--x-3-p-0-media-meta--gap, 0.5rem)'
				)
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'color' => array(
				'text' => true,
				'background' => true,
				'link' => true
			),
			'layout' => array(
				'allowCustomContentAndWideSize' => false,
				'allowEditing' => false,
				'allowInheriting' => false,
				'allowJustification' => true,
				'allowOrientation' => true,
				'allowSizingOnChildren' => false,
				'allowSwitching' => true,
				'allowVerticalAlignment' => true,
				'default' => array(
					'type' => 'flex',
					'flexWrap' => 'wrap',
					'orientation' => 'horizontal',
					'justifyContent' => 'space-between'
				)
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			)
		),
		'usesContext' => array(
			'x3p0/mediaId'
		),
		'attributes' => array(
			'field' => array(
				'type' => 'string',
				'default' => 'title'
			),
			'label' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	)
);
