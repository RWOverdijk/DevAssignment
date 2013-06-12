<?php

namespace Sx\Loader;

require_once __DIR__ . '/SplAutoloader.php';

if (class_exists('Sx\Loader\AutoloaderFactory')) {
    return;
}

class AutoloaderFactory
{

    const STANDARD_AUTOLOADER = 'StandardAutoloader';

    /**
     * @var array All auto loaders registered using the factory method
     */
    protected static $loaders = array();

    /**
     * @var StandardAutoloader StandardAutoloader instance
     *
     */
    protected static $standardAutoloader;

    /**
     * Factory for auto loaders
     *
     * This method will create, and register autoloaders.
     *
     * @param   $options    array   An array of autoloaders
     *
     * @throws Exception\InvalidArgumentException
     * @return  void
     */
    public static function factory($options = null)
    {
        if (is_null($options)) {

            $stdLoaderName = __NAMESPACE__ . static::STANDARD_AUTOLOADER;

            if (!isset(static::$loaders[$stdLoaderName])) {
                $loader                          = static::getStandardAutoloader();
                static::$loaders[$stdLoaderName] = $loader;

                $loader->register();
            }

            // Return because we're done here.
            return;
        }

        if (!is_array($options)) {
            require_once __DIR__ . '/Exception/InvalidArgumentException.php';
            throw new Exception\InvalidArgumentException(
                'Expected array of autoloader classes, got ' . gettype($options)
            );
        }

        foreach ($options as $class) {

            // If we already have the loader, there's no point in adding it again/
            if (isset(static::$loaders[$class])) {
                return;
            }

            if (!is_subclass_of($class, 'Sx\Loader\SplAutoloader')) {
                require_once __DIR__ . '/Exception/InvalidArgumentException.php';
                throw new Exception\InvalidArgumentException(
                    sprintf('Autoloader class %s must implement Sx\\Loader\\SplAutoloader', $class)
                );
            }

            /* @var $autoloader \Sx\Loader\SplAutoloader */
            $autoloader = new $class();

            $autoloader->register();

            static::$loaders[$class] = $autoloader;
        }
    }

    /**
     * Get an instance of the standard autoloader
     * Used as a fallback, and to resolve autoloader classes
     *
     * @return StandardAutoloader
     */
    public static function getStandardAutoloader()
    {
        if (!is_null(static::$standardAutoloader)) {
            return static::$standardAutoloader;
        }

        if (!class_exists(__NAMESPACE__ . static::STANDARD_AUTOLOADER)) {
            require_once __DIR__ . '/' . static::STANDARD_AUTOLOADER . '.php';
        }

        $loaderClassName            = __NAMESPACE__ . '\\' . static::STANDARD_AUTOLOADER;
        $loader                     = new $loaderClassName();
        static::$standardAutoloader = $loader;

        return static::$standardAutoloader;
    }
}
