<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 6:14 PM
 */

namespace App\Model;


class OnePasswordSecureContents
{
    /** @var OnePasswordUrl[] */
    protected $URLs;
    /** @var OnePasswordField[] */
    protected $fields;
    /** @var string */
    protected $password;

    /**
     * @return OnePasswordUrl[]
     */
    public function getURLs(): array
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
    public function setFields(array $fields): OnePasswordSecureContents
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
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
}
