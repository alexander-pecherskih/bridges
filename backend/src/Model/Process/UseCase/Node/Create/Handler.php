<?php

namespace App\Model\Process\UseCase\Node\Create;

use App\Model\Flusher;
use App\Model\Process\Entity\Node\Node;
use App\Model\Process\Entity\Node\NodeRepositoryInterface;
use App\Model\Process\Entity\Node\Position;
use App\Model\Process\Entity\Node\Title;
use App\Model\Process\Entity\Process\ProcessRepositoryInterface;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;

class Handler
{
    private $processRepository;
    private $nodeRepository;
    private $flusher;

    public function __construct(
        NodeRepositoryInterface $nodeRepository,
        ProcessRepositoryInterface $processRepository,
        Flusher $flusher
    ) {
        $this->nodeRepository = $nodeRepository;
        $this->processRepository = $processRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $process = $this->processRepository->get(Uuid::fromString($command->processId));

        $node = new Node(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            new Title($command->title),
            $process,
            new Position($command->top, $command->left)
        );

        $this->nodeRepository->add($node);

        $this->flusher->flush();
    }
}
