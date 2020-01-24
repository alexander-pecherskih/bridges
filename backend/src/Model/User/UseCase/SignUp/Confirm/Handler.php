<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Confirm;

use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepositoryInterface;
use DomainException;

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
        $user = $this->userRepository->findByConfirmToken($command->token);

        if (!$user) {
            throw new DomainException('Unknown user');
        }

        $user->confirmSignUp();

        $this->flusher->flush();
    }
}
