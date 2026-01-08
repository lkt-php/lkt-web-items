<?php

namespace Lkt\WebItems;

use Lkt\Commander\Commander;
use Lkt\WebItems\Console\Commands\SetupTranslationsCommand;
use function Lkt\Tools\Requiring\requireFiles;

requireFiles([
    __DIR__.'/Config/Schemas/*.php',
]);

if (php_sapi_name() == 'cli') {
    Commander::register(new SetupTranslationsCommand());
}