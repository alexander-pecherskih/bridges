<?php

declare(strict_types=1);

namespace App\ReadModel\Process;

use App\Model\Process\Entity\Process\Process;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class ProcessFetcher
{
    private Connection $connection;
    private ObjectRepository $repository;

    public function __construct(Connection $connection, EntityManagerInterface $em)
    {
        $this->connection = $connection;
        $this->repository = $em->getRepository(Process::class);
    }

    public function findAll(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select('p.id, p.title')
            ->from('process', 'p')
            ->orderBy('created', 'asc')
            ->execute();

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }
}
