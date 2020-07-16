<?php

declare(strict_types=1);

namespace App\Model\Process\Entity\Field;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class FieldType extends StringType
{
    public const NAME = 'node_field';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof FieldInterface ? get_class($value) : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return class_exists($value) ? new $value() : null;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
