<?php

namespace App\Factory;

use App\Exception\MapperUnavailableException;
use App\Mapper\GenericEntryMapperInterface;

class GenericEntryFactory
{
    /** @var GenericEntryMapperInterface[] */
    protected $mappers;

    public function mapFrom($object)
    {
        foreach ($this->mappers as $genericEntryMapper) {
            if ($genericEntryMapper->supports($object)) {
                return $genericEntryMapper->createFrom($object);
            }
        }

        throw new MapperUnavailableException('no available mappers for type '.get_class($object));
    }

    public function addMapper(GenericEntryMapperInterface $genericEntryMapper)
    {
        $this->mappers[] = $genericEntryMapper;
    }
}
