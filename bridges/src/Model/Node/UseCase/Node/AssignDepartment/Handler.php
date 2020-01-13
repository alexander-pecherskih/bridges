<?php

namespace App\Model\Node\UseCase\Node\AssignDepartment;

use App\Model\Flusher;
use App\Model\Node\Entity\Node\NodeRepositoryInterface;
use App\Model\Stuff\Entity\Department\DepartmentRepositoryInterface;
use Ramsey\Uuid\Uuid;

class Handler
{
    private $nodeRepository;
    private $departmentRepository;
    private $flusher;

    public function __construct(
        NodeRepositoryInterface $nodeRepository,
        DepartmentRepositoryInterface $departmentRepository,
        Flusher $flusher
    ) {
        $this->nodeRepository = $nodeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $node = $this->nodeRepository->get(Uuid::fromString($command->id));
        $department = $this->departmentRepository->get(Uuid::fromString($command->departmentId));
        $node->assignDepartment($department);
        $this->flusher->flush();
    }
}
