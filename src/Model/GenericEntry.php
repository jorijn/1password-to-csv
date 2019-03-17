<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 7:22 PM.
 */

namespace App\Model;

class GenericEntry
{
    /** @var string */
    protected $group;
    /** @var string */
    protected $title;
    /** @var string */
    protected $username;
    /** @var string */
    protected $password;
    /** @var string */
    protected $url;
    /** @var string */
    protected $notes;
    /** @var \DateTime */
    protected $lastModified;
    /** @var \DateTime */
    protected $createdAt;

    /**
     * @return string
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string $group
     *
     * @return GenericEntry
     */
    public function setGroup(string $group = null): GenericEntry
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return GenericEntry
     */
    public function setTitle(string $title = null): GenericEntry
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return GenericEntry
     */
    public function setUsername(string $username = null): GenericEntry
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return GenericEntry
     */
    public function setPassword(string $password = null): GenericEntry
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return GenericEntry
     */
    public function setUrl(string $url = null): GenericEntry
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     *
     * @return GenericEntry
     */
    public function setNotes(string $notes = null): GenericEntry
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastModified(): ?\DateTime
    {
        return $this->lastModified;
    }

    /**
     * @param \DateTime $lastModified
     *
     * @return GenericEntry
     */
    public function setLastModified(\DateTime $lastModified = null): GenericEntry
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return GenericEntry
     */
    public function setCreatedAt(\DateTime $createdAt = null): GenericEntry
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
