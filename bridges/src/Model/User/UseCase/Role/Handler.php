<?php

namespace App\Model\User\UseCase\Role;

use App\Model\User\Entity\User;
use App\Model\Flusher;
use App\Model\User\Service\ResetTokenizer;
use App\Model\User\Service\ResetTokenSender;
use DateTimeImmutable;
use Exception;

class Handler
{
    private $users;
    private $flusher;

    public function __construct(
        User\UserRepository $users,
        Flusher $flusher
    )
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
        $user = $this->users->get(new User\Id($command->id));

        $user->changeRole(new User\Role($command->role));

        $this->flusher->flush();
    }
}
