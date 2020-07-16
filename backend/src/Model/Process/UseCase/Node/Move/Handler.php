<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Node\Move;

use App\Model\Flusher;
use App\Model\Process\Entity\Node\Node;
use App\Model\Process\Entity\Node\NodeRepositoryInterface;
use App\Model\Process\Entity\Node\Position;
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
        $node->move(new Position($command->top, $command->left));
        $this->flusher->flush();
    }
}
