<?php

namespace Sx\Loader;

require_once __DIR__ . '/SplAutoloader.php';

/**
 * The standard autoloader
 *
 * @package Sx\Loader
 */
class StandardAutoloader implements SplAutoloader
{

    /**
     * @var array A mapping of namespaces to their locations on disk
     */
    protected $namespaces = array();

    /**
     * Auto load a class
     *
     * @param   string $class
     *
     * @return  mixed   false on failure, classname on success
     */
    public function autoload($class)
    {
        $filename = $this->namespaces[strstr($class, '\\', true)] . '/' . str_replace('\\', '/', $class) . '.php';

        if (file_exists($filename)) {

            require_once $filename;

            return $class;
        }

        return false;
    }

    /**
     * Register namespace for auto loading
     *
     * @param string $namespace
     * @param string $path
     */
    public function registerNamespace($namespace, $path)
    {
        $this->namespaces[$namespace] = rtrim($path, '/');
    }

    /**
     * Register the autoloader
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

}
