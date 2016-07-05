<?php

include __DIR__.'/../vendor/autoload.php';

define('APP_ROOT', __DIR__);
define('APP_CWD', getcwd());

/**
 * Create a container, add some services
 */
$container = new Symfony\Component\DependencyInjection\ContainerBuilder();
$extension = new CedricZiel\T3CETool\DependencyInjection\CeToolExtension();

$container->registerExtension($extension);
$container->loadFromExtension($extension->getAlias())
    ->addCompilerPass(new CedricZiel\T3CETool\DependencyInjection\Compiler\ConsoleCommandPass())
    ->addCompilerPass(new CedricZiel\T3CETool\DependencyInjection\Compiler\EventSubscriberPass())
    ->addCompilerPass(new CedricZiel\T3CETool\DependencyInjection\Compiler\FlysystemConfigurationPass())
    ->compile();

$container
    ->get('application')
    ->run();
