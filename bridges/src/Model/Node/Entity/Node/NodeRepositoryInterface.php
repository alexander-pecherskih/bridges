<?php


namespace App\Model\Node\Entity\Node;


use Ramsey\Uuid\UuidInterface;

interface NodeRepositoryInterface
{
    public static function nextId(): UuidInterface;

    public function get(UuidInterface $id): Node;

    public function add(Node $node): void;
}