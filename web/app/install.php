<?php

declare(strict_types=1);

define('BRAVE_INSTALL_DIR', dirname(__FILE__, 3) . '/install');
define('GF_IMPORT_FILE', BRAVE_INSTALL_DIR . '/gravityforms.json');
define('GF_LICENSE_KEY', env('GF_LICENSE_KEY'));
//define('WPLANG', 'nl_NL');

if (! function_exists('wp_install_defaults')) {
	function wp_install_defaults(int $userId): void
	{
		brave_insert_attachments();

		brave_insert_homepage();
		brave_insert_contact_page();
		brave_insert_privacy_policy();
		brave_insert_styleguide();
		brave_insert_menus();

		if (! is_main_site()) {
			foreach (array_keys(get_site_option('active_sitewide_plugins')) as $plugin) {
				do_action('activate_'  . $plugin, false);
				do_action('activate'   . '_plugin', $plugin, false);
			}
		}
	}
}

if (! function_exists('wp_new_blog_notification')) {
	function wp_new_blog_notification()
	{
		// Prevents sending email notifications when installing WordPress
	}
}

add_action('activate_gravityforms/gravityforms.php', function () {
	// TODO: move to Brave hooks or report a bug to Gravity Forms
	if (function_exists('gf_upgrade')) {
		gf_upgrade()->flush_versions();
	}
}, 1);

// Enable the installation of multisite with a specified locale
add_filter('sanitize_option_WPLANG', function ($value, $option, $original_value) {
	return $value;
}, 10, 3);

add_filter('populate_network_meta', function (array $networkMeta): array {
	$networkMeta['fileupload_maxk'] = 70000;
	// TOOD: allowed filetypes

	return $networkMeta;
});

add_action('after_populate_network', function () {
	add_filter('pre_site_option_active_sitewide_plugins', '__return_false', 20);

	activate_plugins([
		'advanced-custom-fields-pro/acf.php',
		'gravityforms/gravityforms.php',
		'wp-seopress/seopress.php',
		'wp-seopress-pro/seopress-pro.php',
	], '', true);

	remove_filter('pre_site_option_active_sitewide_plugins', '__return_false', 20);
});

add_action('gform_post_install', function ($version) {
	//Gravity Forms settings
	update_option('gform_enable_background_updates', false);
	update_option('rg_gforms_default_theme', 'gravity-theme', false);
	update_option('rg_gforms_currency', 'EUR', false);
});

add_action('seopress_activation', function () {
	$data = wp_json_file_decode(BRAVE_INSTALL_DIR . '/seopress.json', ['associative' => true]);
	seopress_get_service('ImportSettings')->handle($data);
	delete_option('seopress_activated');
});

function brave_insert_homepage(): int
{
	$homeId = wp_insert_post([
		'post_title' => __('Home', 'sage'),
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'page',
	]);

	// Assign the created page as the homepage
	update_option('show_on_front', 'page');
	update_option('page_on_front', $homeId);

	return $homeId;
}

function brave_insert_contact_page(): int
{
	$content = require_once BRAVE_INSTALL_DIR . '/pages/contact.php';

	return wp_insert_post([
		'post_title' => __('Contact', 'sage'),
		'post_name' => 'contact',
		'post_content' => serialize_blocks($content),
		'post_status' => 'publish',
		'post_type' => 'page',
	]);
}

function brave_insert_attachments()
{
	// Insert attachment
	WP_Filesystem();
	/** @var WP_Filesystem_Base $wp_filesystem */
	global $wp_filesystem;

	$imagesDir = BRAVE_INSTALL_DIR . '/images';
	$uploadsDir = wp_upload_dir()['path'];

	$files = $wp_filesystem->dirlist(BRAVE_INSTALL_DIR . '/images', false);

	foreach ($files as $file) {
		$wp_filesystem->copy(
			$imagesDir . '/' . $file['name'],
			$uploadsDir . '/' . $file['name']
		);

		$attachmentID = wp_insert_attachment([
			'post_title' => pathinfo($file['name'], PATHINFO_FILENAME),
			'post_content' => '',
			'post_status' => 'inherit',
			'post_mime_type' => wp_get_image_mime($uploadsDir . '/' . $file['name']),
		], $uploadsDir . '/' . $file['name']);

		wp_update_attachment_metadata($attachmentID, wp_generate_attachment_metadata($attachmentID, $uploadsDir . '/' . $file['name']));
	}
}

function brave_insert_privacy_policy(): int
{
	// TODO: tweak the default content of the privacy policy page, e.g. add a link to the contact page and a link to the styleguide
	$content = WP_Privacy_Policy_Content::get_default_content();

	$privacyPolicyId = wp_insert_post([
		'post_title' => __('Privacy policy', 'sage'),
		'post_content' => $content,
		'post_status' => 'publish',
		'post_type' => 'page',
	]);

	update_option('wp_page_for_privacy_policy', $privacyPolicyId);

	return $privacyPolicyId;
}

function brave_insert_styleguide(): int
{
	return wp_insert_post([
		'post_title' => __('Stijlgids', 'sage'),
		'post_name' => 'styleguide',
		'post_content' => '',
		'post_status' => 'private',
		'post_type' => 'page',
	]);
}

function brave_insert_menus()
{
	$menus = [
		'primary_navigation' => __('Hoofdmenu', 'sage'),
		'top_bar_navigation' => __('Top menu', 'sage'),
		'footer_navigation' => __('Footer menu', 'sage'),
	];

	$locations = get_nav_menu_locations();
	foreach ($menus as $location => $menu_name) {
		$menu_id = wp_create_nav_menu($menu_name);
		$locations[$location] = $menu_id;

		foreach (get_pages() as $page) {
			$result = wp_update_nav_menu_item(
				$menu_id,
				0,
				[
					'menu-item-title' => $page->post_title,
					'menu-item-object-id' => $page->ID,
					'menu-item-object' => 'page',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				]
			);
		}
	}
	set_theme_mod('nav_menu_locations', $locations);
}
