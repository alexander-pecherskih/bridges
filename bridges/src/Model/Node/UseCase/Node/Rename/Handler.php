<?php

namespace App\Model\Node\UseCase\Node\Rename;

use App\Model\Flusher;
use App\Model\Node\Entity\Node\Node;
use App\Model\Node\Entity\Node\NodeRepositoryInterface;
use App\Model\Node\Entity\Node\Title;
use Ramsey\Uuid\Uuid;

class Handler
{
    private $nodeRepository;
    private $flusher;

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
