<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Node\Remove;

use App\Model\Flusher;
use App\Model\Process\Entity\Node\NodeRepositoryInterface;
use Ramsey\Uuid\Uuid;

class Handler
{
    private NodeRepositoryInterface $nodeRepository;
    private Flusher $flusher;

    public function __construct(NodeRepositoryInterface $nodeRepository, Flusher $flusher)
    {
        $this->nodeRepository = $nodeRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $node = $this->nodeRepository->get(Uuid::fromString($command->id));

        $this->nodeRepository->remove($node);

        $this->flusher->flush();
    }
}
