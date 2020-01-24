<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Network\Auth;

use App\Model\Flusher;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepositoryInterface;
use DateTimeImmutable;
use DomainException;
use Exception;

class Handler
{
    private UserRepositoryInterface $userRepository;
    private Flusher $flusher;

    public function __construct(UserRepositoryInterface $userRepository, Flusher $flusher)
    {
        $this->userRepository = $userRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        if ($this->userRepository->hasByNetworkIdentity($command->network, $command->identity)) {
            throw new DomainException('User already exists');
        }

        $user = User::signUpByNetwork(
            $this->userRepository->nextId(),
            new DateTimeImmutable(),
            new Name(
                $command->firstName,
                $command->lastName
            ),
            $command->network,
            $command->identity
        );

        $this->userRepository->add($user);

        $this->flusher->flush();
    }
}
