<?php

namespace App\Model\Process\Entity\Node;

use Ramsey\Uuid\UuidInterface;

interface NodeRepositoryInterface
{
    public static function nextId(): UuidInterface;

    public function get(UuidInterface $id): Node;

    public function add(Node $node): void;

    public function remove(Node $node): void;
}
