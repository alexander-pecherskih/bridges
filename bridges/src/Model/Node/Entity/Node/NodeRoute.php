<?php


namespace App\Model\Node\Entity\Node;


/**
 * Class NodeRoute
 * @package App\Entity\Node
 */
class NodeRoute
{
    private $id;
    private $node;
    private $targetNode;
    private $created;
    private $modified;
    private $deleted;

    public function __construct(Node $node, Node $targetNode)
    {
        $this->node = $node;
        $this->targetNode = $targetNode;
    }
}