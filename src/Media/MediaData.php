<?php

/**
 * Media data handler class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Media;

use WP_Post;
use X3P0\MediaData\Field\FieldFactory;
use X3P0\MediaData\Contracts\Field;

/**
 * Manages field data for a single media attachment. Coordinates between
 * the field system and raw WordPress attachment metadata, caching field
 * instances for performance.
 */
class MediaData
{
	/**
	 * Stores the raw attachment metadata.
	 */
	private array $rawMetadata = [];

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
			$this->rawMetadata = wp_get_attachment_metadata($this->post->ID);
		}

		// Create the context object that will be passed to fields.
		$this->context = new MediaContext($this->post, $this->rawMetadata);
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

	public function label(string $key): string
	{
		$field = $this->getField($key);

		return $field ? $field->label() : '';
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

		// Create new field instance via factory.
		$field = $this->fieldFactory->make($key, $this->context);

		// Cache the field (even if null) to avoid repeated lookups.
		$this->fields[$key] = $field;

		return $field;
	}

	/**
	 * Returns the raw metadata array.
	 */
	public function metadata(): array
	{
		return $this->rawMetadata;
	}
}
