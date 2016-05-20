<?php

namespace CedricZiel\T3CETool;

use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * @package CedricZiel\T3CETool
 */
class CeToolApplication extends Application implements ContainerAwareInterface
{
    use ContainerAwareTrait;
}
