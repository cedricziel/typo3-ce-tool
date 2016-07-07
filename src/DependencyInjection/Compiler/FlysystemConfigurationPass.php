<?php

namespace CedricZiel\T3CETool\DependencyInjection\Compiler;

use League\Flysystem\Filesystem;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Sets the filesystems up so that they point to the correct directories
 *
 * @package CedricZiel\T3CETool\DependencyInjection\Compiler
 */
class FlysystemConfigurationPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (defined('APP_CWD')) {
            $extFsDefinition = $container->getDefinition('flysystem.adapter.ext');
            $extFsDefinition->setArguments([APP_CWD]);
        }

        $systemFsDefinition = $container->getDefinition('flysystem.adapter.system');
        $systemFsDefinition->setArguments([APP_ROOT]);

        $mountManagerDefinition = $container->getDefinition('flysystem');
        // grab all tagged services with tag `flysystem.fs` and mount them on the mount manager
        foreach ($container->findTaggedServiceIds('flysystem.fs') as $serviceId => $tags) {
            // a single filesystem can have multiple mount points in the mount manager
            foreach ($tags as $tag) {
                $mountManagerDefinition->addMethodCall(
                    'mountFilesystem',
                    [
                        $tag['alias'],
                        new Reference($serviceId),
                    ]
                );
            }
        }
    }
}
