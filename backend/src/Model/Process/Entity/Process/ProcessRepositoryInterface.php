<?php


namespace App\Model\Process\Entity\Process;


use Ramsey\Uuid\UuidInterface;

interface ProcessRepositoryInterface
{
    public static function nextId(): UuidInterface;

    public function add(Process $process): void;

    public function get(UuidInterface $id): Process;

    public function remove(Process $process): void;
}