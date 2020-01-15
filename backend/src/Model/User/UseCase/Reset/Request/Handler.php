<?php

namespace App\Model\User\UseCase\Reset\Request;

use App\Model\User\Entity\User;
use App\Model\Flusher;
use App\Model\User\Service\ResetTokenizer;
use App\Model\User\Service\ResetTokenSender;
use DateTimeImmutable;
use Exception;

class Handler
{
    private $users;
    private $tokenizer;
    private $sender;
    private $flusher;

    public function __construct(
        User\UserRepositoryInterface $users,
        ResetTokenizer $tokenizer,
        ResetTokenSender $sender,
        Flusher $flusher
    )
    {
        $this->users = $users;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $user = $this->users->getByEmail(new User\Email($command->email));

        $user->requestPasswordReset($this->tokenizer->generate(), new DateTimeImmutable());

        $this->flusher->flush();

        $this->sender->send($user->getEmail(), $user->getResetToken());
    }
}
