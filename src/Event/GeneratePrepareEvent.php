<?php

namespace CedricZiel\T3CETool\Event;

use CedricZiel\T3CETool\Domain\Project;
use Symfony\Component\EventDispatcher\Event;

/**
 * @package CedricZiel\T3CETool\Event
 */
class GeneratePrepareEvent extends Event
{
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
