<?php

namespace App\Model;

class OnePasswordSectionField
{
    /** @var string */
    protected $k;
    /** @var string */
    protected $n;
    /** @var string */
    protected $t;
    /** @var array */
    protected $a = [];
    /** @var string|int|array */
    protected $v;

    /**
     * k = type veld
     * n = ???? type?
     * t = ??? vertaald?
     * v = waarde! als deze leeg is niet meenemen.
     */

    /**
     * @return string
     */
    public function getK(): ?string
    {
        return $this->k;
    }

    /**
     * @param string $k
     */
    public function setK(string $k = null): void
    {
        $this->k = $k;
    }

    /**
     * @return string
     */
    public function getN(): ?string
    {
        return $this->n;
    }

    /**
     * @param string $n
     */
    public function setN(string $n = null): void
    {
        $this->n = $n;
    }

    /**
     * @return string
     */
    public function getT(): ?string
    {
        return $this->t;
    }

    /**
     * @param string $t
     */
    public function setT(string $t = null): void
    {
        $this->t = $t;
    }

    /**
     * @return array
     */
    public function getA(): array
    {
        return $this->a;
    }

    /**
     * @param array $a
     */
    public function setA(array $a = []): void
    {
        $this->a = $a;
    }

    /**
     * @return string
     */
    public function getV(): ?string
    {
        return $this->v;
    }

    /**
     * @param string $v
     */
    public function setV($v = null): void
    {
        switch (gettype($v)) {
            case 'string':
                break;
            case 'array':
                $v = json_encode($v);
                break;
            default:
                $v = (string) $v;
                break;
        }

        $this->v = $v;
    }
}
