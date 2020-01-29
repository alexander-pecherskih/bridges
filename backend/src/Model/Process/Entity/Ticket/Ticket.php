<?php

namespace App\Model\Process\Entity\Ticket;

use App\Model\User\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Ticket
{
    private Id $id;

    private User\User $author;

    private string $text;

    private UuidInterface $processId;

    /**
     * @var Collection|NodeFieldValue[]
     */
    private Collection $nodeFieldValues;

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
