<?php


namespace App\Model\User\Entity\User;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class RoleType extends StringType
{
    public const NAME = 'user_role';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Role ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Role($value) : null;
    }
}