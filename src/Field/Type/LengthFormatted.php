<?php

/**
 * Length Formatted field class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008-2025, Justin Tadlock
 * @license   https://gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-media-data
 */

declare(strict_types=1);

namespace X3P0\MediaData\Field\Type;

use X3P0\MediaData\Field\AbstractField;

/**
 * Displays the media's duration/length, formatted.
 */
final class LengthFormatted extends AbstractField
{
	/**
	 * {@inheritDoc}
	 */
	public function getValue(): mixed
	{
		return $this->media->get('length_formatted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getLabel(): string
	{
		return __('Duration', 'x3p0-media-data');
	}

	/**
	 * {@inheritDoc}
	 */
	public function renderValue(): string
	{
		if (! $duration = $this->getValue()) {
			return '';
		}

		if ($seconds = $this->media->get('length')) {
			return sprintf(
				'<time class="%s" datetime="%s" property="duration">%s</time>',
				$this->scopeClass('value'),
				esc_attr($this->secondsToIso8601($seconds)),
				esc_html($duration)
			);
		}

		return sprintf(
			'<div class="%s">%s</div>',
			$this->scopeClass('value'),
			esc_html($duration)
		);
	}

	public function render(string $attrs, string $label = ''): string {
		if (! $this->hasValue()) {
			return '';
		}

		return sprintf(
			'<div %s>%s %s</div>',
			$attrs,
			$this->renderLabel($label),
			$this->renderValue()
		);
	}

	private function secondsToIso8601(int $seconds): string
	{
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds % 3600) / 60);
		$secs = $seconds % 60;

		$duration = 'PT';

		if ($hours > 0) {
			$duration .= $hours . 'H';
		}
		if ($minutes > 0) {
			$duration .= $minutes . 'M';
		}
		if ($secs > 0 || $seconds === 0) {
			$duration .= $secs . 'S';
		}

		return $duration;
	}
}
