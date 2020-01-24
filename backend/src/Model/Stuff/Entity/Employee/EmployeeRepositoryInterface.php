<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Employee;

use Ramsey\Uuid\UuidInterface;

interface EmployeeRepositoryInterface
{
    public function get(UuidInterface $id): Employee;

    public function add(Employee $employee): void;

    public function remove(Employee $employee): void;
}
