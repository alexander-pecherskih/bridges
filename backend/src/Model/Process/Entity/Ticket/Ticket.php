<?php

namespace App\Model\Process\Entity\Ticket;

use App\Model\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Ticket
{
    private $id;

    private $author;

    private $text;

    private $processId;

    /**
     * @var ArrayCollection|NodeFieldValue[]
     */
    private $nodeFieldValues;

    public function __construct(Id $id, UuidInterface $processId, User\User $author, string $text)
    {
        $this->id = $id;
        $this->processId = $processId;
        $this->author = $author;
        $this->text = $text;

        $this->nodeFieldValues = new ArrayCollection();
    }

    public function addNodeFieldValue(NodeFieldValue $nodeFieldValue)
    {
        $this->nodeFieldValues->add($nodeFieldValue);
    }
}
