<?php

namespace App\Model\Process\UseCase\Node\Rename;

use App\Model\Flusher;
use App\Model\Process\Entity\Node\Node;
use App\Model\Process\Entity\Node\NodeRepositoryInterface;
use App\Model\Process\Entity\Node\Title;
use Ramsey\Uuid\Uuid;

class Handler
{
    private NodeRepositoryInterface $nodeRepository;
    private Flusher $flusher;

    public function __construct(
        NodeRepositoryInterface $nodeRepository,
        Flusher $flusher
    ) {
        $this->nodeRepository = $nodeRepository;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        /** @var Node $node */
        $node = $this->nodeRepository->get(Uuid::fromString($command->id));
        $node->rename(new Title($command->title));
        $this->flusher->flush();
    }
}
