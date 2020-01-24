<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Edit;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Employee\Email;
use App\Model\Stuff\Entity\Employee\EmployeeRepositoryInterface;
use App\Model\Stuff\Entity\Employee\Name;
use Exception;
use Ramsey\Uuid\Uuid;

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

        $employee->edit(
            new Name($command->firstName, $command->lastName, $command->patronymic),
            new Email($command->email),
            $command->position
        );

        $this->flusher->flush();
    }
}
