<?php

namespace CedricZiel\T3CETool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Initializes a CE-Tool project
 *
 * @package CedricZiel\T3CETool\Command
 */
class InitCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Initializes a CE Tool project')
            ->setHelp(
                <<<EOT
Initializes a project and creates a .t3cetool.yml file                
EOT
            )
            ->setDefinition(
                [
                    new InputOption('name', 'p', InputOption::VALUE_REQUIRED, 'Name of your project')
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
