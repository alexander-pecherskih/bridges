<?php

namespace App\ReadModel\Process;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Ramsey\Uuid\UuidInterface;

class NodeFetcher
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAllByProcess(UuidInterface $processId): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select('n.id', 'n.title', 'n.created', 'n.position_top', 'n.position_left')
            ->from('nodes', 'n')
            ->andWhere('n.process_id = :processId')
            ->setParameter(':processId', $processId)
            ->execute();

        return $stmt->fetchAll(FetchMode::ASSOCIATIVE);
    }
}
