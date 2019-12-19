<?php


namespace App\Model\Ticket\Entity\Ticket;


use App\Entity\Ticket\NodeFieldValue;
use App\Model\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;


class Ticket
{
    private $id;

    private $author;

    private $text;

    private $nodeId;

    /**
     * @var ArrayCollection|NodeFieldValue[]
     */
    private $nodeFieldValues;

    public function __construct(int $id, User\User $author, string $text, int $nodeId)
    {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->nodeId = $nodeId;

        $this->nodeFieldValues = new ArrayCollection();
    }

    public function addNodeFieldValue(NodeFieldValue $nodeFieldValue)
    {
        $this->nodeFieldValues->add($nodeFieldValue);
    }
}