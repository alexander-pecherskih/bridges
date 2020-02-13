<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Reset\Reset;

use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepositoryInterface;
use App\Model\Flusher;
use App\Model\User\Service\PasswordHasher;
use DateTimeImmutable;
use Exception;

class Handler
{
    private UserRepositoryInterface $users;
    private PasswordHasher $hasher;
    private Flusher $flusher;

    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasher $hasher,
        Flusher $flusher
    ) {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        /** @var User $user */
        $user = $this->users->getByResetToken($command->token);

        $user->resetPassword($this->hasher->hash($command->password), new DateTimeImmutable());

        $this->flusher->flush();
    }
}
