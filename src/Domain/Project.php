<?php

namespace CedricZiel\T3CETool\Domain;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @package CedricZiel\T3CETool\Domain
 */
class Project extends Extension
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $authorEmail;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var Extension[]
     */
    protected $dependencies;

    /**
     * @var string
     */
    protected $vendor;

    /**
     * @var string
     */
    protected $namespace;

    public function __construct()
    {
        $this->dependencies = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return Project
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     *
     * @return Project
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return Project
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * @param string $authorEmail
     *
     * @return Project
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return Project
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Extension[]
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param Extension[] $dependencies
     *
     * @return Project
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    /**
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param string $vendor
     *
     * @return Project
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }
}
