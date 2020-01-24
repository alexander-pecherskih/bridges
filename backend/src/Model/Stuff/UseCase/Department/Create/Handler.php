<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Create;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Company\CompanyRepositoryInterface;
use App\Model\Stuff\Entity\Department\Department;
use App\Model\Stuff\Entity\Department\DepartmentRepositoryInterface;
use App\Model\Stuff\Entity\Department\Title;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @property DepartmentRepositoryInterface $departmentRepository
 * @property CompanyRepositoryInterface $companyRepository
 * @property Flusher $flusher
 */
class Handler
{
    private DepartmentRepositoryInterface $departmentRepository;
    private CompanyRepositoryInterface $companyRepository;
    private Flusher $flusher;

    public function __construct(
        DepartmentRepositoryInterface $departmentRepository,
        CompanyRepositoryInterface $companyRepository,
        Flusher $flusher
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->companyRepository = $companyRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $department = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $this->companyRepository->get(Uuid::fromString($command->company)),
            new Title($command->title),
            $command->parent ? $this->departmentRepository->get(Uuid::fromString($command->parent)) : null
        );

        $this->departmentRepository->add($department);

        $this->flusher->flush();
    }
}
