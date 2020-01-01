<?php


namespace App\Model\Process\Entity\Process;

use App\Model\Node\Entity\Node\Node;
use App\Model\User\Entity\User\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DomainException;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Process
 * @package App\Entity
 * @ORM\Entity
 */
class Process
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    private $created;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Model\User\Entity\User\User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @var Title
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @var Node|null $startNode
     *
     * @ORM\ManyToOne(targetEntity="App\Model\Node\Node")
     * @ORM\JoinColumn(name="start_node_id", referencedColumnName="id", nullable=true)
     */
    private $startNode;

    /**
     * @var ArrayCollection|Node[] $nodes
     *
     * @ORM\OneToMany(
     *     targetEntity="Node",
     *     mappedBy="process",
     *     orphanRemoval=true,
     *     cascade={"all"}
     * )
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private $nodes;


    public function __construct(UuidInterface $id, DateTimeImmutable $created, User $owner, Title $title)
    {
        $this->id = $id;
        $this->created = $created;
        $this->owner = $owner;
        $this->title = $title;

        $this->nodes = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getStartNode(): ?Node
    {
        return $this->startNode;
    }

    public function rename(Title $title): void
    {
        $this->title = $title;
    }

    /**
     * @param Node $node
     */
    public function setStartNode(Node $node): void
    {
        if ($node->getProcess()->getId() !== $this->id) {
            throw new DomainException('The Node does not belong to this Process');
        }

        $this->startNode = $node;
    }
}