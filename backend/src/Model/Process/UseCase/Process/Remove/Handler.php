<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Process\Remove;

use App\Model\Flusher;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use Ramsey\Uuid\Uuid;

class Handler
{
    private $processRepository;
    private $flusher;

    public function __construct(ProcessRepositoryInterface $processRepository, Flusher $flusher)
    {
        $this->processRepository = $processRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $process = $this->processRepository->get(Uuid::fromString($command->id));

        $this->processRepository->remove($process);

        $this->flusher->flush();
    }
}
