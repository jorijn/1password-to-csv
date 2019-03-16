<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 6:16 PM
 */

namespace App\Model;


class OnePasswordUrl
{
    /** @var string */
    protected $label;
    /** @var string */
    protected $url;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return OnePasswordUrl
     */
    public function setLabel(string $label): OnePasswordUrl
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return OnePasswordUrl
     */
    public function setUrl(string $url): OnePasswordUrl
    {
        $this->url = $url;

        return $this;
    }
}
