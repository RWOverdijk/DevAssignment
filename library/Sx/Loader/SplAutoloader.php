<?php

namespace Sx\Loader;

if (interface_exists('Sx\Loader\SplAutoloader')) {
    return;
}

/**
 * A set of defined methods for classes that wish to be registered as an autoloader.
 *
 * @package Sx\Loader
 */
interface SplAutoloader
{
    /**
     * Autoload a class
     *
     * @param   string  $class
     * @return  mixed   false on failure, get_class on success
     */
    public function autoload($class);

    /**
     * Register the autoloader
     *
     * @return void
     */
    public function register();
}
