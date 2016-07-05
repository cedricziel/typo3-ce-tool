<?php

namespace CedricZiel\T3CETool\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @package CedricZiel\T3CETool\DependencyInjection\Compiler
 */
class EventSubscriberPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $eventDispatcher = $container->getDefinition('event_dispatcher');
        $eventSubscriber = $container->findTaggedServiceIds('kernel.event_subscriber');
        foreach ($eventSubscriber as $serviceId => $tags) {
            $eventDispatcher->addMethodCall(
                'addSubscriberService',
                [$serviceId, $container->getDefinition($serviceId)->getClass()]
            );
        }
    }
}
