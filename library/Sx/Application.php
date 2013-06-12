<?php

namespace Sx;

require_once __DIR__ . '/Loader/AutoloaderFactory.php';

use Sx\Loader\AutoloaderFactory;

class Application
{
    public function __construct()
    {
        AutoloaderFactory::factory();
        AutoloaderFactory::getStandardAutoloader()->registerNamespace(
            __NAMESPACE__,
            realpath(__DIR__ . '/../')
        );
    }
}
