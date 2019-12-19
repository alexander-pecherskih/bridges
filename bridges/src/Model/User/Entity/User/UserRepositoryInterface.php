<?php


namespace App\Model\User\Entity\User;


interface UserRepositoryInterface
{
    public function nextId(): Id;

    public function add(User $user): void;

    public function get(Id $id): User;

    public function getByEmail(Email $email): User;

    public function findByConfirmToken(string $token): ?User;

    public function hasByNetworkIdentity(string $network, string $identity): bool;
}