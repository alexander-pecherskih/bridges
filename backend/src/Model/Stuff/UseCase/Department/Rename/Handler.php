<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Rename;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Department\DepartmentRepositoryInterface;
use App\Model\Stuff\Entity\Department\Title;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @property DepartmentRepositoryInterface $departmentRepository
 */
class Handler
{
    private DepartmentRepositoryInterface $departmentRepository;
    private Flusher $flusher;

    public function __construct(DepartmentRepositoryInterface $departmentRepository, Flusher $flusher)
    {
        $this->departmentRepository = $departmentRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $department = $this->departmentRepository->get(Uuid::fromString($command->id));

        $department->rename(new Title($command->title));

        $this->flusher->flush();
    }
}
