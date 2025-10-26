<?php

/**
 * Media attachment architecture - separated concerns.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Attachment;

use WP_Post;
use X3P0\MediaData\Contracts\{MediaData, MediaFactory};
use X3P0\MediaData\Field\FieldFactory;

/**
 * Factory for creating AttachmentData instances.
 */
class AttachmentFactory implements MediaFactory
{
	public function __construct(private FieldFactory $fieldFactory) {}

	/**
	 * Creates an AttachmentData instance from a media ID.
	 */
	public function make(int $mediaId): ?MediaData
	{
		$post = get_post($mediaId);

		if (! $post instanceof WP_Post || 'attachment' !== get_post_type($post)) {
			return null;
		}

		return new AttachmentData($post, $this->fieldFactory);
	}
}
