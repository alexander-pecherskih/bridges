<?php


namespace App\Model\Process\Entity\Process;


use Ramsey\Uuid\UuidInterface;

interface ProcessRepositoryInterface
{
    public static function nextId(): UuidInterface;
}