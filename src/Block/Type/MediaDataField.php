<?php

/**
 * Media meta field block class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Block\Type;

use WP_Block;
use X3P0\MediaData\Block\Block;
use X3P0\MediaData\Field\FieldResolver;

/**
 * Renders the `x3p0/media-data-field` block on the front end.
 */
final class MediaDataField implements Block
{
	/**
	 * Creates an array of allowed HTML within field labels, which should be
	 * used with a function like `wp_kses()`.
	 *
	 * @todo Type hint with PHP 8.3+ requirement.
	 */
	protected const ALLOWED_HTML = [
		'abbr'    => [ 'title' => true ],
		'acronym' => [ 'title' => true ],
		'code'    => true,
		'em'      => true,
		'span'    => [ 'class' => true ],
		'strong'  => true,
		'sup'     => true,
		'sub'     => true,
		'i'       => true,
		'b'       => true
	];

	/**
	 * The media attachment ID.
	 */
	protected int $mediaId = 0;

	/**
	 * Automatically ensures that block attributes exist or fall back to
	 * their defaults. Also gets the media ID from the block context.
	 */
	public function __construct(
		protected FieldResolver $fieldResolver,
		protected array         $attributes,
		protected WP_Block      $block
	) {
		$this->attributes['field'] = $this->attributes['field'] ?? 'title';
		$this->attributes['label'] = $this->attributes['label'] ?? '';

		$this->mediaId = $this->block->context['x3p0-media-data/mediaId'] ?? 0;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(): string
	{
		if (! $this->mediaId) {
			return '';
		}

		// Gets the field object.
		$field = $this->fieldResolver->resolve(
			$this->mediaId,
			$this->attributes['field']
		);

		// If no field, bail early.
		if (! $field) {
			return '';
		}

		// Get the user label if there is one. Fall back to field label.
		$label = $this->attributes['label'] ?: $field->getLabel();

		// Create the label HTML.
		$labelHtml = '<div class="wp-block-x3p0-media-data-field__label">';
		$labelHtml .= wp_kses($label, self::ALLOWED_HTML);
		$labelHtml .= '</div>';

		// Create the content HTML.
		$contentHtml = '<div class="wp-block-x3p0-media-data-field__value">';
		$contentHtml .= $field->renderValue();
		$contentHtml .= '</div>';

		// Get the block HTML attributes.
		$attr = get_block_wrapper_attributes([
			'class' => sanitize_html_class(sprintf(
				'wp-block-x3p0-media-data-field--%s',
				str_replace('_', '-', $this->attributes['field'])
			))
		]);

		// Return the formatted block.
		return "<div {$attr}>{$labelHtml} {$contentHtml}</div>";
	}
}
