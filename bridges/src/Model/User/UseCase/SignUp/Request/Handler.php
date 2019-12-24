<?php

namespace App\Model\User\UseCase\SignUp\Request;

use App\Model\User\Entity\User;
use App\Model\Flusher;
use App\Model\User\Service\PasswordHasher;
use App\Model\User\Service\SignUpConfirmTokenizer;
use App\Model\User\Service\SignUpConfirmTokenSender;
use DateTimeImmutable;
use DomainException;
use Exception;
use Twig\Error;

class Handler
{
    private $users;
    private $hasher;
    private $tokenizer;
    private $sender;
    private $flusher;

    public function __construct(
        User\UserRepository $users,
        PasswordHasher $hasher,
        SignUpConfirmTokenizer $tokenizer,
        SignUpConfirmTokenSender $sender,
        Flusher $flusher
    )
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Error\LoaderError
     * @throws Error\RuntimeError
     * @throws Error\SyntaxError
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $email = new User\Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new DomainException('User already exists.');
        }

        $user = User\User::signUpByEmail(
            $this->users->nextId(),
            new DateTimeImmutable(),
            new User\Name( $command->firstName, $command->lastName, $command->patronymic ),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);

        $this->sender->send($email, $token);

        $this->flusher->flush();
    }
}
