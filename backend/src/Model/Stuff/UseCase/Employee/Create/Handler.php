<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Create;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Company\CompanyRepositoryInterface;
use App\Model\Stuff\Entity\Employee\Email;
use App\Model\Stuff\Entity\Employee\Employee;
use App\Model\Stuff\Entity\Employee\EmployeeRepositoryInterface;
use App\Model\Stuff\Entity\Employee\Name;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @property EmployeeRepositoryInterface $employeeRepository
 * @property CompanyRepositoryInterface $companyRepositoryInterface
 * @property Flusher $flusher
 */
class Handler
{
    private CompanyRepositoryInterface $companyRepository;
    private EmployeeRepositoryInterface $employeeRepository;
    private Flusher $flusher;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        CompanyRepositoryInterface $companyRepository,
        Flusher $flusher
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $company = $this->companyRepository->get(Uuid::fromString($command->companyId));

        $employee = new Employee(
            Uuid::fromString($command->id),
            new DateTimeImmutable(),
            $company,
            new Name($command->firstName, $command->lastName, $command->patronymic),
            new Email($command->email),
            $command->position ?? null
        );

        $this->employeeRepository->add($employee);

        $this->flusher->flush();
    }
}
