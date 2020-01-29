<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Email\Request;

use App\Model\Flusher;
use App\Model\User\Entity\User;
use App\Model\User\Service\NewEmailConfirmTokenizer;
use App\Model\User\Service\NewEmailConfirmTokenSender;
use DomainException;
use Ramsey\Uuid\Uuid;

class Handler
{
    private User\UserRepositoryInterface $userRepository;
    private NewEmailConfirmTokenizer $tokenizer;
    private NewEmailConfirmTokenSender $sender;
    private Flusher $flusher;

    public function __construct(
        User\UserRepositoryInterface $userRepository,
        NewEmailConfirmTokenizer $tokenizer,
        NewEmailConfirmTokenSender $sender,
        Flusher $flusher
    ) {
        $this->userRepository = $userRepository;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $user = $this->userRepository->get(Uuid::fromString($command->id));

        $email = new User\Email($command->email);

        if ($this->userRepository->hasByEmail($email)) {
            throw new DomainException('Email is already in use.');
        }

        $user->requestEmailChanging(
            $email,
            $token = $this->tokenizer->generate()
        );

        $this->flusher->flush();

        $this->sender->send($email, $token);
    }
}
