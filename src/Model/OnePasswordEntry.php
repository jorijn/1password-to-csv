<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 6:11 PM
 */

namespace App\Model;


class OnePasswordEntry
{
    /** @var string */
    protected $uuid;
    /** @var int|\DateTime */
    protected $updatedAt;
    /** @var string */
    protected $locationKey;
    /** @var string */
    protected $securityLevel;
    /** @var string */
    protected $contentsHash;
    /** @var string */
    protected $title;
    /** @var string */
    protected $location;
    /** @var OnePasswordSecureContents */
    protected $secureContents;
    /** @var int|\DateTime */
    protected $createdAt;
    /** @var string */
    protected $typeName;

    /**
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     */
    public function setUpdatedAt(int $updatedAt): void
    {
        $this->updatedAt = \DateTime::createFromFormat('U', $updatedAt);;
    }

    /**
     * @return string
     */
    public function getLocationKey(): ?string
    {
        return $this->locationKey;
    }

    /**
     * @param string $locationKey
     */
    public function setLocationKey(string $locationKey): void
    {
        $this->locationKey = $locationKey;
    }

    /**
     * @return string
     */
    public function getSecurityLevel(): ?string
    {
        return $this->securityLevel;
    }

    /**
     * @param string $securityLevel
     */
    public function setSecurityLevel(string $securityLevel): void
    {
        $this->securityLevel = $securityLevel;
    }

    /**
     * @return string
     */
    public function getContentsHash(): ?string
    {
        return $this->contentsHash;
    }

    /**
     * @param string $contentsHash
     */
    public function setContentsHash(string $contentsHash): void
    {
        $this->contentsHash = $contentsHash;
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
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return OnePasswordSecureContents
     */
    public function getSecureContents(): ?OnePasswordSecureContents
    {
        return $this->secureContents;
    }

    /**
     * @param OnePasswordSecureContents $secureContents
     */
    public function setSecureContents(OnePasswordSecureContents $secureContents): void
    {
        $this->secureContents = $secureContents;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt(int $createdAt): void
    {
        $this->createdAt = \DateTime::createFromFormat('U', $createdAt);
    }

    /**
     * @return string
     */
    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    /**
     * @param string $typeName
     */
    public function setTypeName(string $typeName): void
    {
        $this->typeName = $typeName;
    }
}
