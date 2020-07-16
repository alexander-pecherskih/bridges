<?php

namespace App\Repository;

use App\Model\Process\Entity\Field;
use Model\Process\Entity\Field\FieldRepositoryInterface;
use ReflectionClass;

class FieldRepository implements FieldRepositoryInterface
{
    private const INT_FIELD = Field\IntField::class;
    private const INN_FIELD = Field\InnField::class;
    private const REFERENCE_FIELD = Field\ReferenceField::class;

    public function get(string $className): Field\FieldInterface
    {
        return new $className();
    }

    /**
     * @return Field\FieldInterface[]
     */
    public static function getList(): array
    {
        return [
            (new ReflectionClass(self::INT_FIELD))->newInstance(),
            (new ReflectionClass(self::INN_FIELD))->newInstance(),
            (new ReflectionClass(self::REFERENCE_FIELD))->newInstance(),
        ];
    }
}
