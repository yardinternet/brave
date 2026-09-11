@php
	/**
	 * @var array $attributes
	 * @var string $blockDefaultClassname
	 * @var string $blockWrapperAttributes
	 * @var string $content
	 */
@endphp

<x-brave-back-button :align="isset($attributes['align']) ? 'align' . $attributes['align'] : ''" :class-name="$attributes['className'] ?? ''" />
