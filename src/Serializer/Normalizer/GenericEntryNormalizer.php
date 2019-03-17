<?php

namespace App\Serializer\Normalizer;

use App\Model\GenericEntry;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GenericEntryNormalizer implements NormalizerInterface
{
    public function normalize($object, $format = null, array $context = []): array
    {
        /* @var GenericEntry $object */
        return [
            'group' => $object->getGroup(),
            'title' => $object->getTitle(),
            'username' => $object->getUsername(),
            'password' => $object->getPassword(),
            'url' => $object->getUrl(),
            'notes' => $object->getNotes(),
            'modified' => $object->getLastModified()->format('U'),
            'created' => $object->getCreatedAt()->format('U'),
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof GenericEntry;
    }
}
