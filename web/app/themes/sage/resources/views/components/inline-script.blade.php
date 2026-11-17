@php(wp_print_inline_script_tag((string) $slot, array_filter($attributes->getAttributes(), static fn ($value) => $value !== null)))
