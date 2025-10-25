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

namespace X3P0\MediaData\Block;

use WP_Block;
use X3P0\MediaData\Contracts\Block;
use X3P0\MediaData\Media\MediaRepository;

/**
 * Renders the Breadcrumbs block on the front end.
 */
class MediaDataField implements Block
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

	protected int $mediaId = 0;

	/**
	 * Sets the block attributes.
	 */
	public function __construct(
		protected MediaRepository $mediaRepository,
		protected array $attributes,
		protected WP_Block $block
	) {
		$this->attributes['field'] = $this->attributes['field'] ?? 'file_name';
		$this->attributes['label'] = $this->attributes['label'] ?? '';

		$this->mediaId = $this->block->context['x3p0/mediaId'] ?? 0;

		if (! $this->mediaId && 'attachment' === get_post_type()) {
			$this->mediaId = get_the_ID() ?: 0;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(): string
	{
		if (! $this->mediaId) {
			return '';
		}

		$mediaData = $this->mediaRepository->get($this->mediaId);

		// Bail if the field doesn't exist.
		if (! $mediaData->has($this->attributes['field'])) {
			return '';
		}

		$label = $this->attributes['label'] ?: $mediaData->label(
			$this->attributes['field']
		);

		// Create the label HTML.
		$labelHtml = '<div class="wp-block-x3p0-media-data-field__label">';
		$labelHtml .= wp_kses($label, self::ALLOWED_HTML);
		$labelHtml .= '</div>';

		// Create the content HTML.
		$contentHtml = '<div class="wp-block-x3p0-media-data-field__content">';
		$contentHtml .= $mediaData->render($this->attributes['field']);
		$contentHtml .= '</div>';

		// Get the block HTML attributes.
		$attr = get_block_wrapper_attributes([
			'class' => sprintf(
				'wp-block-x3p0-media-data-field--%s',
				esc_attr(str_replace('_', '-', $this->attributes['field']))
			)
		]);

		// Return the formatted block.
		return sprintf(
			'<div %s>%s %s</div>',
			$attr,
			$labelHtml,
			$contentHtml
		);
	}
}
