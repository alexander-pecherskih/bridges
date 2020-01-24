<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Remove;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Employee\EmployeeRepositoryInterface;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @property EmployeeRepositoryInterface $employeeRepository
 */
class Handler
{
    private EmployeeRepositoryInterface $employeeRepository;
    private Flusher $flusher;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, Flusher $flusher)
    {
        $this->employeeRepository = $employeeRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $employee = $this->employeeRepository->get(Uuid::fromString($command->id));

        $this->employeeRepository->remove($employee);

        $this->flusher->flush();
    }
}
