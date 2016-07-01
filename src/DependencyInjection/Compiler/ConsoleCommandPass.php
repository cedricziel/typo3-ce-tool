<?php

namespace CedricZiel\T3CETool\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @package CedricZiel\T3CETool\DependencyInjection\Compiler
 */
class ConsoleCommandPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $commands = $container->findTaggedServiceIds('console.command');
        $applicationDefinition = $container->getDefinition('application');
        foreach ($commands as $serviceId => $serviceDefinition) {
            $applicationDefinition->addMethodCall('add', [new Reference($serviceId)]);
        }
    }
}
