<?php

declare(strict_types=1);

namespace Deployer;

use Yard\Deployer\Host;
use Yard\Deployer\Loader;
use function Yard\Deployer\shockServer;
use function Yard\Deployer\wp;

require_once __DIR__ . '/vendor/sourcebroker/deployer-loader/autoload.php';

new Loader();

// Config
set('repository', 'git@github.com:yardinternet/brave');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

////////// For demo brave/gemeente sites only
after('deploy:vendors', function () {
	$alias = currentHost()->getAlias();

	if ('accept' === $alias) {
		within('{{release_or_current_path}}', function () {
			run('{{bin/composer}} private-packages');
			run('{{bin/composer}} require yard/brave-scaffold --dev');
			wp('acorn scaffold:news');
			wp('acorn scaffold:person');
			wp('acorn scaffold:knowledgebase');
		});
	}

	if ('gemeente-accept' === $alias) {
		within('{{release_or_current_path}}', function () {
			run('{{bin/composer}} private-packages');
			run('{{bin/composer}} gemeente-packages');
		});
	}
})->desc('Scaffold brave and gemeente demo sites.');
//////////

// Hosts.
shockServer(Host::SHOCK_STAGING_1);

shockServer(Host::SHOCK_STAGING_1, ['gemeente']);
