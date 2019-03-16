<?php
/**
 * Created by PhpStorm.
 * User: jorijn
 * Date: 3/16/19
 * Time: 6:24 PM
 */

namespace App\Model;


class OnePasswordDateTime
{
    /** @var \DateTime */
    protected $dateTime;

    public function __construct(int $unixTimestamp = null)
    {
        if ($unixTimestamp !== null) {
            $this->dateTime = \DateTime::createFromFormat('U', $unixTimestamp);
        }
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;
    }
}
