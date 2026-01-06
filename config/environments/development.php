<?php

declare(strict_types=1);
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use function Env\env;
use Roots\WPConfig\Config;
use Spatie\Ignition\Config\IgnitionConfig;
use Spatie\Ignition\Ignition;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', env('WP_DEBUG') ?? true);
Config::define('WP_DEBUG_DISPLAY', env('WP_DEBUG_DISPLAY') ?? true);
Config::define('WP_DEBUG_LOG', env('WP_DEBUG_LOG') ?? true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);
Config::define('DISALLOW_INDEXING', true);
Config::define('WP_DEVELOPMENT_MODE', 'theme'); // @see https://make.wordpress.org/core/2023/07/14/configuring-development-mode-in-6-3/

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);

Config::define('DISABLED_PLUGINS', [
	'sites-monitor/sites-monitor.php',
	'stream/stream.php',
	'wordfence/wordfence.php',
]);

/**
 * Register Ignition
 */
$ignitionConfig = (new IgnitionConfig())
	->setOption('remote_sites_path', env('IGNITION_REMOTE_SITES_PATH') ?? '/app')
	->setOption('local_sites_path', env('IGNITION_LOCAL_SITES_PATH') ?? '');

Ignition::make()
	->setConfig($ignitionConfig)
	->applicationPath(dirname(__DIR__, 2))
	->setEditor(env('IGNITION_EDITOR') ?? 'phpstorm')
	->setTheme(env('IGNITION_THEME') ?? 'auto')
	->register();
