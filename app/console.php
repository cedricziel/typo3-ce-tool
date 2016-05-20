<?php

include __DIR__.'/../vendor/autoload.php';

define('APP_NAME', 'TYPO3 CE Tool');
define('APP_ROOT', __DIR__);
define('APP_VERSION', '0.0.1-dev');
define('APP_CWD', getcwd());

$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
$dispatcher = new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($container);

$container->compile();

$application = new \CedricZiel\T3CETool\CeToolApplication(APP_NAME, APP_VERSION);
$application->setDispatcher($dispatcher);
$application->setContainer($container);

$application->addCommands(
    [
        new  \CedricZiel\T3CETool\Command\InitCommand(),
    ]
);

$application->run();
