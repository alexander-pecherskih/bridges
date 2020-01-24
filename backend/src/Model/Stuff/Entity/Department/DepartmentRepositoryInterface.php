<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Department;

use Ramsey\Uuid\UuidInterface;

interface DepartmentRepositoryInterface
{
    public function get(UuidInterface $id): Department;

    public function add(Department $department): void;

    public function remove(Department $department): void;
}
