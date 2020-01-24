<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Move;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Department\DepartmentRepositoryInterface;
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
        $parent = $this->departmentRepository->get(Uuid::fromString($command->parent));

        $department->move($parent);

        $this->flusher->flush();
    }
}
