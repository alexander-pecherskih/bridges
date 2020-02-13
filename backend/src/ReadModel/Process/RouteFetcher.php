<?php

namespace App\ReadModel\Process;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Ramsey\Uuid\UuidInterface;

class RouteFetcher
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAllByProcess(UuidInterface $processId): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select('r.id, r.source_id, r.target_id')
            ->from('routes', 'r')
            ->andWhere('r.process_id = :processId')
            ->setParameter(':processId', $processId)
            ->execute();

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }
}
