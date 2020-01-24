<?php

namespace App\Model\Process\Entity\Node;

use App\Model\Process\Entity\Handler\Handler;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class NodeHandler
{
    private UuidInterface $id;
    private Node $node;
    private Handler $handler;
    private array $settings;
    private DateTimeImmutable $created;
    private ?DateTimeImmutable $modified = null;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Node $node,
        Handler $handler,
        array $settings
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->node = $node;
        $this->handler = $handler;
        $this->settings = $settings;
    }

    public function getModified(): ?DateTimeImmutable
    {
        return $this->modified;
    }
}
