<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Create;

use App\Model\Stuff\Entity\Department\Department;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class Handler
{
    private $repo;
    private $em;

    public function __construct(GroupRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    public function handle(Command $comand): void
    {
        $group = new Department(
            $command->title
        );

        $this->groupRepository->create($group);
    }

    /**
     * @param Command $dto
     * @throws EntityNotFoundException
     */
    public function update(Command $dto): void
    {
        $group = $this->groupRepository->get($dto->id);

        $group->setTitle($dto->title);

        /**/

        $this->em->flush();
    }
}
