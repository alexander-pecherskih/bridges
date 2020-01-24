<?php

namespace App\Model\Process\UseCase\Process\Rename;

use App\Model\Flusher;
use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use App\Model\Process\Entity\Process\Title;
use Ramsey\Uuid\Uuid;

class Handler
{
    private ProcessRepositoryInterface $processRepository;
    private Flusher $flusher;

    public function __construct(
        ProcessRepositoryInterface $processRepository,
        Flusher $flusher
    ) {
        $this->processRepository = $processRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        /** @var Process $process */
        $process = $this->processRepository->get(Uuid::fromString($command->id));
        $process->rename(new Title($command->title));
        $this->flusher->flush();
    }
}
