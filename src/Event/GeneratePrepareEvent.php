<?php

namespace CedricZiel\T3CETool\Event;

use CedricZiel\T3CETool\Domain\Project;
use Symfony\Component\EventDispatcher\Event;

/**
 * @package CedricZiel\T3CETool\Event
 */
class GeneratePrepareEvent extends Event
{
    const EVENT_NAME = 't3ce:project:generate:pre';

    /**
     * @var Project
     */
    private $project;

    /**
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
