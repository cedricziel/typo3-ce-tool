<?php

namespace CedricZiel\T3CETool\Initialization;

use CedricZiel\T3CETool\Domain\Project;

/**
 * @package CedricZiel\T3CETool\Initialization
 */
class InitializationService implements InitializationServiceInterface
{
    /**
     * @var Project
     */
    protected $project;

    public function __construct()
    {
        $this->project = new Project();
    }

    /**
     * Reads a yml config and de-serializes it onto the project entity
     *
     * @param string $config
     */
    public function readConfig($config)
    {
        
    }
}
