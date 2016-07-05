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
            $extFsDefinition = $container->getDefinition('flysystem.fs.ext');
            $extFsDefinition->setArguments([APP_CWD]);
        }

        $systemFsDefinition = $container->getDefinition('flysystem.fs.system');
        $systemFsDefinition->setArguments([APP_ROOT]);

        $mountManagerDefinition = $container->getDefinition('flysystem');
        foreach ($container->findTaggedServiceIds('flysystem.fs') as $serviceId => $tags) {
            foreach ($tags as $tag) {
                $filesystem = new Definition();
                $filesystem->setClass(Filesystem::class);
                $filesystem->addArgument(new Reference($serviceId));

                $mountManagerDefinition->addMethodCall('mountFilesystem', [$tag['alias'], $filesystem]);
            }
        }
    }
}
