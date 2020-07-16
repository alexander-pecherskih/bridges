<?php

namespace App\Service\Normalizer;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Normalizer for Uuid
 *
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritdoc
     */
    public function denormalize($data, $class, string $format = null, array $context = [])
    {
        if (null === $data) {
            return null;
        }

        return Uuid::fromString($data);
    }

    /**
     * @inheritdoc
     */
    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return (Uuid::class === $type || UuidInterface::class === $type)
            && $this->isValid($data)
            ;
    }

    private function isValid($data)
    {
        return $data === null
            || (is_string($data) && Uuid::isValid($data))
            ;
    }
}
