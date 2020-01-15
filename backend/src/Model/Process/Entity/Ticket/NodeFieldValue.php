<?php

namespace App\Model\Process\Entity\Ticket;


use App\Model\Process\Entity\Node\NodeField;
use App\Model\Ticket\Entity\Ticket\ValueInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class NodeFieldValue
 * @package App\Entity\Ticket
 *
 * @ORM/Entity()
 */
class NodeFieldValue
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    private $id;

    /**
     * @var NodeField
     * @ORM\OneToMany()
     */
    private $nodeField;
    private $value;

    public function __construct(int $id, NodeField $nodeField, ValueInterface $value)
    {
        $this->id = $id;
        $this->nodeField = $nodeField;
        $this->value = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNodeField(): NodeField
    {
        return $this->nodeField;
    }

    public function getValue(): ValueInterface
    {
        return $this->value;
    }
}