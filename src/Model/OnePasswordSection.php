<?php

namespace App\Model;

class OnePasswordSection
{
    /** @var string */
    protected $title;
    /** @var string */
    protected $name;
    /** @var OnePasswordSectionField[] */
    protected $fields = [];

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
    public function setTitle(string $title = null): void
    {
        $this->title = $title;
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
     */
    public function setName(string $name = null): void
    {
        $this->name = $name;
    }

    /**
     * @return OnePasswordSectionField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param OnePasswordSectionField[] $fields
     */
    public function setFields(array $fields = []): void
    {
        $this->fields = $fields;
    }
}
