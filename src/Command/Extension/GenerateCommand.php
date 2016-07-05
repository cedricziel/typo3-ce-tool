<?php

namespace CedricZiel\T3CETool\Command\Extension;

use CedricZiel\T3CETool\Configuration\ConfigurationManagerInterface;
use CedricZiel\T3CETool\Event\GeneratePrepareEvent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @package CedricZiel\T3CETool\Command\Extension
 */
class GenerateCommand extends Command
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var ConfigurationManagerInterface
     */
    private $configurationManager;

    /**
     * GenerateCommand constructor.
     *
     * @param EventDispatcherInterface      $eventDispatcher
     * @param ConfigurationManagerInterface $configurationManager
     * @param string                        $name
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        ConfigurationManagerInterface $configurationManager,
        $name = null
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->configurationManager = $configurationManager;

        parent::__construct($name);
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('extension:generate')
            ->setAliases(['generate'])
            ->setDescription('Generate the project from the specification');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $project = $this->configurationManager->get();

        $this->eventDispatcher->dispatch(GeneratePrepareEvent::EVENT_NAME, new GeneratePrepareEvent($project));
        $this->eventDispatcher->dispatch('generate');
        $this->eventDispatcher->dispatch('generate:post');
        $this->eventDispatcher->dispatch('generate:cleanup');
    }
}
