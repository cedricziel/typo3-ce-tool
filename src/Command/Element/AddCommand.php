<?php

namespace CedricZiel\T3CETool\Command\Element;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Adds a content element through a quick questionnaire
 *
 * @package CedricZiel\T3CETool\Command\Element
 */
class AddCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('element:add')
            ->setDescription('Adds an element');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Adding an element through the wizard</info>');
    }
}
