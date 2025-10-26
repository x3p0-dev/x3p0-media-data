<?php

/**
 * Attachment media data handler class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Attachment;

use WP_Post;
use X3P0\MediaData\Contracts\{Field, MediaContext, MediaData};
use X3P0\MediaData\Field\FieldFactory;

/**
 * Manages field data for a single media attachment. Coordinates between the
 * field system and raw WordPress attachment metadata, caching field instances
 * for performance.
 */
class AttachmentData implements MediaData
{
	/**
	 * Stores the raw attachment data.
	 */
	private array $data = [];

	/**
	 * Stores instantiated field objects, keyed by field name.
	 */
	private array $fields = [];

	/**
	 * Stores the media context passed to fields.
	 */
	private MediaContext $context;

	/**
	 * Sets up the media data object.
	 */
	public function __construct(
		protected ?WP_Post $post,
		private FieldFactory $fieldFactory
	) {
		// If we have a valid attachment post object, get the metadata.
		if (
			$this->post instanceof WP_Post
			&& 'attachment' === get_post_type($this->post)
		) {
			$this->data = wp_get_attachment_metadata($this->post->ID);
		}

		// Create the context object that will be passed to fields.
		$this->context = new AttachmentContext($this->post, $this->data);
	}

	/**
	 *
	 * Returns the raw metadata array.
	 */
	public function data(): array
	{
		return $this->data;
	}

	/**
	 * Checks if the field exists and has a value for this media.
	 */
	public function has(string $key): bool
	{
		$field = $this->getField($key);

		return $field && $field->exists();
	}

	/**
	 * Returns the escaped and formatted field value.
	 */
	public function render(string $key): string
	{
		$field = $this->getField($key);

		return $field ? $field->render() : '';
	}

	/**
	 * Returns the field label.
	 */
	public function renderLabel(string $key): string
	{
		$field = $this->getField($key);

		return $field ? $field->renderLabel() : '';
	}

	/**
	 * Gets or creates a field instance for the given key.
	 */
	private function getField(string $key): ?Field
	{
		// Return cached field if it exists.
		if (isset($this->fields[$key])) {
			return $this->fields[$key];
		}

		// Create new field instance via factory. This also caches null
		// fields to avoid repeated lookups.
		$this->fields[$key] = $this->fieldFactory->make($key, $this->context);

		return $this->fields[$key];
	}
}
