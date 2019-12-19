<?php


namespace App\Model\User\UseCase\SignUp\Confirm;


use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepository;
use DomainException;

class Handler
{
    private $users;
    private $flusher;

    public function __construct( UserRepository $users, Flusher $flusher )
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $user = $this->users->findByConfirmToken($command->token);

        if (!$user) {
            throw new DomainException('Unknown user');
        }

        $user->confirmSignUp();

        $this->flusher->flush();
    }
}