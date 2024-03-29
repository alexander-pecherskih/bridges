<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;

use App\Model\Flusher;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepositoryInterface;
use App\Model\User\Service\PasswordHasher;
use App\Model\User\Service\SignUpConfirmTokenizer;
use App\Model\User\Service\SignUpConfirmTokenSender;
use DateTimeImmutable;
use DomainException;
use Exception;
use Twig\Error;

class Handler
{
    private UserRepositoryInterface $userRepository;
    private PasswordHasher $hasher;
    private SignUpConfirmTokenizer $tokenizer;
    private SignUpConfirmTokenSender $sender;
    private Flusher $flusher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordHasher $hasher,
        SignUpConfirmTokenizer $tokenizer,
        SignUpConfirmTokenSender $sender,
        Flusher $flusher
    ) {
        $this->userRepository = $userRepository;
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
        $email = new Email($command->email);

        if ($this->userRepository->hasByEmail($email)) {
            throw new DomainException('User already exists.');
        }

        $user = User::signUpByEmail(
            $this->userRepository->nextId(),
            new DateTimeImmutable(),
            new Name($command->firstName, $command->lastName, $command->patronymic),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->userRepository->add($user);

        $this->sender->send($email, $token);

        $this->flusher->flush();
    }
}
