<?php

namespace App\Mapper;

use App\Model\GenericEntry;

interface GenericEntryMapperInterface
{
    public function createFrom($object): GenericEntry;

    public function supports($object): bool;
}
