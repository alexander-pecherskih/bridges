<?php


namespace App\Model\User\Entity\User;


interface NetworkRepositoryInterface
{
    public static function nextId(): int;
}