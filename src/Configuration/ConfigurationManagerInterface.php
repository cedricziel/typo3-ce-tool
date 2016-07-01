<?php

namespace CedricZiel\T3CETool\Configuration;

use CedricZiel\T3CETool\Domain\Project;

/**
 * Reads and writes configuration from and to yaml project specifications
 *
 * @package CedricZiel\T3CETool\Configuration
 */
interface ConfigurationManagerInterface
{
    /**
     * Clears the current configuration
     */
    public function clear();

    /**
     * Returns the last read configuration
     *
     * @return Project
     */
    public function get() : Project;

    /**
     * Reads configuration from
     *
     * @throws ConfigurationUnavailableException
     * @return Project
     */
    public function read() : Project;

    /**
     * Writes a project specification to disk
     *
     * @param Project $project
     */
    public function write(Project $project);
}
