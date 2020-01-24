<?php

namespace App\Model\Process\Entity\Node;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

/**
 * Class NodeRoute
 * @package App\Entity\Node
 */
class NodeRoute
{
    private UuidInterface $id;
    private Node $node;
    private Node $targetNode;
    private DateTimeImmutable $created;
    private ?DateTimeImmutable $modified = null;
    private ?DateTimeImmutable $deleted = null;

    public function __construct(Node $node, Node $targetNode)
    {
        $this->node = $node;
        $this->targetNode = $targetNode;
    }
}
