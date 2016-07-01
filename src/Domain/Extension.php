<?php

namespace CedricZiel\T3CETool\Domain;

/**
 * @package CedricZiel\T3CETool\Domain
 */
class Extension
{
    /**
     * @var string
     */
    protected $extensionKey;

    /**
     * @var string
     */
    protected $versionConstraint;

    /**
     * @return string
     */
    public function getExtensionKey()
    {
        return $this->extensionKey;
    }

    /**
     * @param string $extensionKey
     *
     * @return Extension
     */
    public function setExtensionKey($extensionKey)
    {
        $this->extensionKey = $extensionKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersionConstraint()
    {
        return $this->versionConstraint;
    }

    /**
     * @param string $versionConstraint
     *
     * @return Extension
     */
    public function setVersionConstraint($versionConstraint)
    {
        $this->versionConstraint = $versionConstraint;

        return $this;
    }
}
