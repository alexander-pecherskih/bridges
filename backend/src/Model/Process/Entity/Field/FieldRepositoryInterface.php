<?php

declare(strict_types=1);

namespace Model\Process\Entity\Field;

use App\Model\Process\Entity\Field\FieldInterface;

interface FieldRepositoryInterface
{
    public function get(string $className): FieldInterface;

    /**
     * @return FieldInterface[]
     */
    public static function getList(): array;
}
