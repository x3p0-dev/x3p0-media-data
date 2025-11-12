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
		'providesContext' => array(
			'x3p0-media-data/mediaId' => 'mediaId',
			'x3p0-media-data/metadata' => 'metadata'
		),
		'usesContext' => array(
			'postId',
			'postType'
		),
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'allowedBlocks' => array(
			'x3p0/media-data-field'
		),
		'attributes' => array(
			'mediaId' => array(
				'type' => 'integer',
				'default' => 0,
				'role' => 'content'
			)
		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'__experimentalBorder' => array(
				'radius' => true,
				'color' => true,
				'width' => true,
				'style' => true,
				'__experimentalDefaultControls' => array(
					'width' => true,
					'color' => true
				)
			),
			'__experimentalStyle' => array(
				'css' => '&.is-layout-flex { gap: var(--wp--custom--x-3-p-0-media-data--gap, 0.5rem); }',
				'spacing' => array(
					'blockGap' => 'var(--wp--custom--x-3-p-0-media-data--gap, 0.5rem)'
				)
			),
			'color' => array(
				'link' => false,
				'gradients' => true,
				'__experimentalDefaultControls' => array(
					'background' => true,
					'text' => true
				)
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
					'orientation' => 'vertical',
					'justifyContent' => 'stretch'
				)
			),
			'shadow' => true,
			'spacing' => array(
				'blockGap' => true,
				'margin' => true,
				'padding' => true,
				'__experimentalDefaultControls' => array(
					'blockGap' => true,
					'margin' => false,
					'padding' => true
				)
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalTextTransform' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			)
		)
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
		'usesContext' => array(
			'x3p0-media-data/mediaId',
			'x3p0-media-data/metadata'
		),
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php',
		'attributes' => array(
			'field' => array(
				'type' => 'string',
				'default' => 'title',
				'role' => 'content'
			),
			'label' => array(
				'type' => 'string',
				'default' => '',
				'role' => 'content'
			)
		),
		'supports' => array(
			'anchor' => true,
			'html' => false,
			'__experimentalBorder' => array(
				'radius' => true,
				'color' => true,
				'width' => true,
				'style' => true,
				'__experimentalDefaultControls' => array(
					'width' => true,
					'color' => true
				)
			),
			'__experimentalStyle' => array(
				'css' => '&.is-layout-flex { gap: var(--wp--custom--x-3-p-0-media-data-field--gap, 0.5rem); }',
				'spacing' => array(
					'blockGap' => 'var(--wp--custom--x-3-p-0-media-data-field--gap, 0.5rem)'
				)
			),
			'color' => array(
				'link' => false,
				'gradients' => true,
				'__experimentalDefaultControls' => array(
					'background' => true,
					'text' => true
				)
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
			'shadow' => true,
			'spacing' => array(
				'blockGap' => true,
				'margin' => true,
				'padding' => true,
				'__experimentalDefaultControls' => array(
					'blockGap' => true,
					'margin' => false,
					'padding' => true
				)
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalLetterSpacing' => true,
				'__experimentalTextTransform' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true
				)
			)
		)
	)
);
