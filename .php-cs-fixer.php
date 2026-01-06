<?php

declare(strict_types=1);

use PhpCsFixer\Finder;
use Yard\PhpCsFixerRules\Config;

# PHP CS Fixer can be run using the VSCode extension on save
# or by using the command line `composer run-scripts format`
# Our current setup only formats PHP files, not blade.php files.
# However, you can install Laravel Blade Formatter (shufo.vscode-blade-formatter)
# which, if installed globally, also supports the command line `blade-formatter --write **/*.blade.php.`

$finder = Finder::create()
	->in(__DIR__)
	->append(['.php-cs-fixer.php'])
	->name('*.php')
	->name('_ide_helper')
	->notName('*.blade.php')
	->ignoreDotFiles(true)
	->ignoreVCS(true)

	->exclude('app/cache')
	->exclude('public')
	->exclude('mu-plugins')
	->exclude('node_modules')
	->exclude('plugins')
	->exclude('vendor')
	->exclude('web/wp')
	->exclude('web/app/wflogs')
	->exclude('web/app/uploads')
	->exclude('web/app/themes/sage/storage/framework/cache')
	->exclude('web/app/themes/sage/storage/framework/sessions')
	->exclude('web/app/themes/sage/storage/framework/views')
	->notPath('web/index.php');

return Config::create($finder);
