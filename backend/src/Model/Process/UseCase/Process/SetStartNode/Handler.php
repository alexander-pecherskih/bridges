<?php

namespace App\Model\Process\UseCase\Process\SetStartNode;

use App\Model\Flusher;
use App\Model\Process\Entity\Node\NodeRepositoryInterface;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use Ramsey\Uuid\Uuid;

class Handler
{
    private $processRepository;
    private $nodeRepository;
    private $flusher;

    public function __construct(
        ProcessRepositoryInterface $processRepository,
        NodeRepositoryInterface $nodeRepository,
        Flusher $flusher
    ) {
        $this->processRepository = $processRepository;
        $this->nodeRepository = $nodeRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $process = $this->processRepository->get(Uuid::fromString($command->id));
        $node = $this->nodeRepository->get(Uuid::fromString($command->nodeId));
        $process->setStartNode($node);
        $this->flusher->flush();
    }
}
