<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Name;

use App\Model\Flusher;
use App\Model\User\Entity\User\Name;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

class Handler
{
    private UserRepository $userRepository;
    private Flusher $flusher;

    public function __construct(UserRepository $userRepository, Flusher $flusher)
    {
        $this->userRepository = $userRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws EntityNotFoundException
     */
    public function handle(Command $command): void
    {
        $user = $this->userRepository->get(Uuid::fromString($command->id));

        $user->changeName(new Name(
            $command->first,
            $command->last,
            $command->patronymic
        ));

        $this->flusher->flush();
    }
}
