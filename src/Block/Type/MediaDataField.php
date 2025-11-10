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
		'abbr'    => [ 'class' => true, 'title' => true ],
		'acronym' => [ 'class' => true, 'title' => true ],
		'b'       => [ 'class' => true ],
		'cite'    => [ 'class' => true ],
		'code'    => [ 'class' => true ],
		'del'     => [ 'class' => true ],
		'em'      => [ 'class' => true ],
		'i'       => [ 'class' => true ],
		'ins'     => [ 'class' => true ],
		'mark'    => [ 'class' => true ],
		's'       => [ 'class' => true ],
		'span'    => [ 'class' => true ],
		'strong'  => [ 'class' => true ],
		'sub'     => [ 'class' => true ],
		'sup'     => [ 'class' => true ],
		'u'       => [ 'class' => true ]
	];

	/**
	 * Sets up the initial object state.
	 */
	public function __construct(protected readonly FieldResolver $fieldResolver)
	{}

	/**
	 * {@inheritdoc}
	 */
	public function render(array $attributes, string $content, WP_Block $block): string {
		$attributes['field'] = $attributes['field'] ?? 'title';

		$mediaId = $block->context['x3p0-media-data/mediaId'] ?? 0;

		if (! $mediaId) {
			return '';
		}

		// Gets the field object.
		$field = $this->fieldResolver->resolve($mediaId, $attributes['field']);

		// If no field, bail early.
		if (! $field) {
			return '';
		}

		// Get the user label if there is one. Fall back to field label.
		$label = $attributes['label'] ?: $field->getLabel();

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
				str_replace('_', '-', $attributes['field'])
			))
		]);

		// Return the formatted block.
		return "<div {$attr}>{$labelHtml} {$contentHtml}</div>";
	}
}
