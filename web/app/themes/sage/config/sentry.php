<?php

declare(strict_types=1);

/**
 * Sentry Laravel SDK configuration file.
 *
 * @see https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/
 */
return [
	// The release version of your application
	'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

	// When left empty or `null` the Laravel environment will be used (usually discovered from `APP_ENV` in your `.env`)
	'environment' => env('WP_ENV'),

	// @see: https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/#traces-sample-rate
	'traces_sample_rate' => (float) env('SENTRY_TRACES_SAMPLE_RATE', 0.01),
];
