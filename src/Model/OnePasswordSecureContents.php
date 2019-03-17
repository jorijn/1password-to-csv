<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 6:14 PM.
 */

namespace App\Model;

class OnePasswordSecureContents
{
    /** @var OnePasswordUrl[] */
    protected $URLs;
    /** @var OnePasswordField[] */
    protected $fields = [];
    /** @var string */
    protected $password;
    /** @var string */
    protected $reg_code;
    /** @var OnePasswordSection[] */
    protected $sections;
    /** @var string */
    protected $notesPlain;

    /**
     * @return OnePasswordUrl[]
     */
    public function getURLs(): ?array
    {
        return $this->URLs;
    }

    /**
     * @param OnePasswordUrl[] $URLs
     *
     * @return OnePasswordSecureContents
     */
    public function setURLs(array $URLs): OnePasswordSecureContents
    {
        $this->URLs = $URLs;

        return $this;
    }

    /**
     * @return OnePasswordField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param OnePasswordField[] $fields
     *
     * @return OnePasswordSecureContents
     */
    public function setFields(array $fields = []): OnePasswordSecureContents
    {
        $this->fields = $fields;

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
     * @return OnePasswordSecureContents
     */
    public function setPassword(string $password): OnePasswordSecureContents
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegCode(): ?string
    {
        return $this->reg_code;
    }

    /**
     * @param string $reg_code
     */
    public function setRegCode(string $reg_code = null): void
    {
        $this->reg_code = $reg_code;
    }

    /**
     * @return OnePasswordSection[]
     */
    public function getSections(): ?array
    {
        return $this->sections;
    }

    /**
     * @param OnePasswordSection[] $sections
     */
    public function setSections(array $sections = null): void
    {
        $this->sections = $sections;
    }

    /**
     * @return string
     */
    public function getNotesPlain(): ?string
    {
        return $this->notesPlain;
    }

    /**
     * @param string $notesPlain
     */
    public function setNotesPlain(string $notesPlain = null): void
    {
        $this->notesPlain = $notesPlain;
    }
}
