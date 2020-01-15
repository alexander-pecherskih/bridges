<?php

namespace App\Model\Process\UseCase\Process\Create;

use App\Model\Flusher;
use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use App\Model\Process\Entity\Process\Title;
use App\Model\User\Entity\User\UserRepositoryInterface;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class Handler
{
    private $processRepository;
    private $userRepository;
    private $flusher;

    public function __construct(
        ProcessRepositoryInterface $processRepository,
        UserRepositoryInterface $userRepository,
        Flusher $flusher
    ) {
        $this->processRepository = $processRepository;
        $this->userRepository = $userRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $user = $this->userRepository->get(Uuid::fromString($command->userId));

        $process = new Process(
            $this->processRepository::nextId(),
            new DateTimeImmutable(),
            $user,
            new Title($command->title)
        );

        $this->processRepository->add($process);

        $this->flusher->flush();
    }
}
