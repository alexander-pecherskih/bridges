<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

interface NetworkRepositoryInterface
{
    public static function nextId(): int;
}
