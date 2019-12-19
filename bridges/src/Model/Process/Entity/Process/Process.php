<?php


namespace App\Model\Process\Entity\Process;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Model\User\Entity\User\User;

/**
 * Class Process
 * @package App\Entity
 * @ORM\Entity
 */
class Process
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", unique=true)
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
     * @var Node\Node $startNode
     *
     */
    private $startNode;

    /**
     * @var ArrayCollection | Node\Node[] $nodes
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

    /**
     * @ORM\Column(name="modified", type="datetime_immutable", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $modified;

    public function __construct(int $id, string $title, User $owner)
    {
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;

        $this->nodes = new ArrayCollection();
    }

    public function setStartNode(Node\Node $node): void
    {
        $this->startNode = $node;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getModified(): ?DateTimeImmutable
    {
        return $this->modified;
    }
}