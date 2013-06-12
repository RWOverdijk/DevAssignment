<?php

/**
 * Setting up simple auto loading
 */
require_once __DIR__ . '/library/Sx/Application.php';

$application = new \Sx\Application;

Sx\Loader\AutoloaderFactory::getStandardAutoloader()->registerNamespace(
    'Application',
    realpath(__DIR__ . '/application/src/')
);
