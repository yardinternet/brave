<?php

declare(strict_types=1);

if (! function_exists('wp_install_defaults')) {
	function wp_install_defaults(int $userId): void
	{
		//	prevent creating default content (posts, pages, etc.) when installing WordPress
	}
}

if (! function_exists('wp_new_blog_notification')) {
	function wp_new_blog_notification()
	{
		// Prevents sending email notifications when installing WordPress
	}
}

// Enable the installation of multisite with a specified locale
add_filter('sanitize_option_WPLANG', function ($value, $option, $original_value) {
	if (wp_installing()) {
		return $original_value;
	}

	return $value;
}, 10, 3);
