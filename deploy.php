<?php

declare(strict_types=1);

namespace Deployer;

use Yard\Deployer\Host;
use Yard\Deployer\Loader;
use Yard\Deployer\Stage;
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
	if (get('labels')['site'] ?? '' === 'brave') {
		within('{{release_or_current_path}}', function () {
			run('{{bin/composer}} private-packages');
			run('{{bin/composer}} require yard/brave-scaffold --dev');
			wp('acorn scaffold:news');
			wp('acorn scaffold:person');
			wp('acorn scaffold:knowledgebase');
		});
	}

	if (get('labels')['site'] ?? '' === 'gemeente') {
		within('{{release_or_current_path}}', function () {
			run('{{bin/composer}} gemeente-packages');
		});
	}
})->desc('Scaffold default content types for Brave');
//////////

// Hosts.
host(Host::WPACC01)
	->setDeployPath('/data/www/accept-sites/yard/brave')
	->setLabels(['stage' => Stage::ACCEPT, 'site' => 'brave']);

host(Host::WPACC01)
	->setDeployPath('/data/www/accept-sites/yard/gemeente')
	->setLabels(['stage' => Stage::ACCEPT, 'site' => 'gemeente']);