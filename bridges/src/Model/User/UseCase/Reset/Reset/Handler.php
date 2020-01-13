<?php

namespace App\Model\User\UseCase\Reset\Reset;

use App\Model\User\Entity\User;
use App\Model\Flusher;
use App\Model\User\Service\PasswordHasher;
use DateTimeImmutable;
use Exception;

class Handler
{
    private $users;
    private $hasher;
    private $flusher;

    public function __construct(
        User\UserRepositoryInterface $users,
        PasswordHasher $hasher,
        Flusher $flusher
    )
    {
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
        /** @var User\User $user */
        $user = $this->users->getByResetToken($command->token);

        $user->resetPassword($this->hasher->hash($command->password), new DateTimeImmutable());

        $this->flusher->flush();
    }
}
