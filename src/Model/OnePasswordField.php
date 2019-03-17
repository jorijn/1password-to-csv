<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 6:15 PM.
 */

namespace App\Model;

class OnePasswordField
{
    /** @var string */
    protected $id;
    /** @var string */
    protected $value;
    /** @var string */
    protected $name;
    /** @var string */
    protected $type;
    /** @var string */
    protected $designation;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return OnePasswordField
     */
    public function setId(string $id): OnePasswordField
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return OnePasswordField
     */
    public function setValue(string $value): OnePasswordField
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return OnePasswordField
     */
    public function setName(string $name): OnePasswordField
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return OnePasswordField
     */
    public function setType(string $type): OnePasswordField
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    /**
     * @param string $designation
     *
     * @return OnePasswordField
     */
    public function setDesignation(string $designation): OnePasswordField
    {
        $this->designation = $designation;

        return $this;
    }
}
