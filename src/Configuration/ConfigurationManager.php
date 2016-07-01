<?php

namespace CedricZiel\T3CETool\Configuration;

use CedricZiel\T3CETool\Domain\Project;

/**
 * @package CedricZiel\T3CETool\Configuration
 */
class ConfigurationManager implements ConfigurationManagerInterface
{
    /**
     * Clears the current configuration
     */
    public function clear()
    {
        // TODO: Implement clear() method.
    }

    /**
     * Returns the last read configuration
     *
     * @return Project
     */
    public function get() : Project
    {
        // TODO: Implement get() method.
    }

    /**
     * Reads configuration from
     *
     * @throws ConfigurationUnavailableException
     * @return Project
     */
    public function read() : Project
    {
        // TODO: Implement read() method.
    }

    /**
     * Writes a project specification to disk
     *
     * @param Project $project
     */
    public function write(Project $project)
    {
        // TODO: Implement write() method.
    }
}
