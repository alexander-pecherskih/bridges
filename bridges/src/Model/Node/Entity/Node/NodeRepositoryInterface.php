<?php


namespace App\Model\Node\Entity\Node;


interface NodeRepositoryInterface
{
    public static function nextId(): int;
}