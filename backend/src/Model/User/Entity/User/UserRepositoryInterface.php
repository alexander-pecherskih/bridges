<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Ramsey\Uuid\UuidInterface;

interface UserRepositoryInterface
{
    public static function nextId(): UuidInterface;

    public function add(User $user): void;

    public function get(UuidInterface $id): User;

    public function getByEmail(Email $email): User;

    public function getByResetToken(string $token): User;

    public function hasByEmail(Email $email): bool;

    public function hasByNetworkIdentity(string $network, string $identity): bool;

    public function findByConfirmToken(string $token): ?User;
}
