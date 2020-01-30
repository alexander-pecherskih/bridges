<?php

namespace App\Model\User\UseCase\Role;

use App\Model\User\Entity\User;
use App\Model\Flusher;
use Exception;
use Ramsey\Uuid\Uuid;

class Handler
{
    private User\UserRepositoryInterface $users;
    private Flusher $flusher;

    public function __construct(User\UserRepositoryInterface $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $user = $this->users->get(Uuid::fromString($command->id));

        $user->changeRole(new User\Role($command->role));

        $this->flusher->flush();
    }
}
