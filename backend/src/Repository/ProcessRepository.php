<?php

namespace App\Repository;

use App\Model\EntityNotFoundException;
use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProcessRepository implements ProcessRepositoryInterface
{
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Process::class);
    }

    /**
     * @return UuidInterface
     * @throws Exception
     */
    public static function nextId(): UuidInterface
    {
        return Uuid::uuid4();
    }

    public function add(Process $process): void
    {
        $this->em->persist($process);
    }

    /**
     * @param UuidInterface $id
     * @return Process
     * @throws EntityNotFoundException
     */
    public function get(UuidInterface $id): Process
    {
        /** @var Process $process */
        if (!$process = $this->repo->find($id)) {
            throw new EntityNotFoundException('Process not found');
        }

        return $process;
    }

    public function remove(Process $process): void
    {
        $this->em->remove($process);
    }
}
