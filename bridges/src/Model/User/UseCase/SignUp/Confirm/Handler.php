<?php


namespace App\Model\User\UseCase\SignUp\Confirm;


use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepository;
use DomainException;

class Handler
{
    private $userRepository;
    private $flusher;

    public function __construct( UserRepository $userRepository, Flusher $flusher )
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