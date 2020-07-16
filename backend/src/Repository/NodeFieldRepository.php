<?php

namespace App\Repository;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class NodeFieldRepository
{
    /**
     * @return UuidInterface
     * @throws \Exception
     */
    public static function nextId(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
