<?php

namespace CedricZiel\T3CETool\Configuration;

use CedricZiel\T3CETool\Domain\Project;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @package CedricZiel\T3CETool\Configuration
 */
class ConfigurationManager implements ConfigurationManagerInterface
{
    const CONTROL_FILENAME = 't3cetool.yml';

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

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
        return $this->read();
    }

    /**
     * Reads configuration from
     *
     * @throws ConfigurationUnavailableException
     * @return Project
     */
    public function read() : Project
    {
        $content = file_get_contents(getcwd().'/.t3cetool.yml');
        if ($content === false) {
            throw new ConfigurationUnavailableException('Could not open configuration file');
        }

        return $this->serializer->deserialize($content, Project::class, 'yaml');
    }

    /**
     * Writes a project specification to disk
     *
     * @param Project $project
     */
    public function write(Project $project)
    {
        file_put_contents(getcwd().'/.'.static::CONTROL_FILENAME, $this->serializer->serialize($project, 'yaml'));
    }
}
