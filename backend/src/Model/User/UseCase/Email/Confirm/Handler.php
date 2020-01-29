<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Email\Confirm;

use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepositoryInterface;
use Ramsey\Uuid\Uuid;

class Handler
{
    private UserRepositoryInterface $userRepository;
    private Flusher $flusher;

    public function __construct(UserRepositoryInterface $userRepository, Flusher $flusher)
    {
        $this->userRepository = $userRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $user = $this->userRepository->get(Uuid::fromString($command->id));

        $user->confirmEmailChanging($command->token);

        $this->flusher->flush();
    }
}
