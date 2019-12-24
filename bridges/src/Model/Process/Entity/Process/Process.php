<?php


namespace App\Model\Process\Entity\Process;

use App\Model\Node\Entity\Node\Node;
use App\Model\User\Entity\User\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

/**
 * Class Process
 * @package App\Entity
 * @ORM\Entity
 */
class Process
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $title;

    /**
     * @var Node|null $startNode
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

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    public function __construct(UuidInterface $id, DateTimeImmutable $created, Title $title, User $owner)
    {
        $this->id = $id;
        $this->created = $created;
        $this->title = $title;
        $this->owner = $owner;

        $this->nodes = new ArrayCollection();
    }

    public function setStartNode(Node $node): void
    {
        $this->startNode = $node;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getStartNode(): ?Node
    {
        return $this->startNode;
    }
}