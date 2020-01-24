<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Move;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Department\DepartmentRepositoryInterface;
use App\Model\Stuff\Entity\Employee\EmployeeRepositoryInterface;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @property EmployeeRepositoryInterface $employeeRepository
 * @property DepartmentRepositoryInterface $departmentRepository
 */
class Handler
{
    private EmployeeRepositoryInterface $employeeRepository;
    private DepartmentRepositoryInterface $departmentRepository;
    private Flusher $flusher;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository,
        Flusher $flusher
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $employee = $this->employeeRepository->get(Uuid::fromString($command->id));
        $department = $this->departmentRepository->get(Uuid::fromString($command->departmentId));

        $employee->assignDepartment($department);

        $this->flusher->flush();
    }
}
