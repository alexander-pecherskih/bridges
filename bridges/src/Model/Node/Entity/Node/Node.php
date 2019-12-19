<?php


namespace App\Model\Node\Entity\Node;


use App\Model\Node\Entity\Field\FieldInterface;
use App\Entity\Process;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * Class Node
 * @package App\Entity
 * @ORM\Entity()
 */
class Node
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    private $id;

    /**
     * @var Process
     * @ORM\ManyToOne(targetEntity="Process")
     * @ORM\JoinColumn(name="process_id", referencedColumnName="id")
     */
    private $process;

    /**
     * @var Group
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $group;

    /**
     * @var NodeTitle
     * @ORM\Column(type="text", length=255)
     */
    private $title;

    /**
     * @var Position
     * @ORM\Embedded(class="Position")
     */
    private $position;

    /**
     * @var ArrayCollection|NodeField[]
     *
     * @ORM\OneToMany(
     *     targetEntity="NodeField",
     *     mappedBy="node",
     *     orphanRemoval=true,
     *     cascade={"all"}
     * )
     * @ORM\OrderBy({"title" = "ASC"})

     */
    private $nodeFields;

//    /**
//     * @var ArrayCollection|NodeHandler[]
//     * @ORM\OneToMany(
//     *     targetEntity="NodeHandler",
//     *     mappedBy="node",
//     *     orphanRemoval=true,
//     *     cascade={"all"}
//     * )
//     * @ORM\OrderBy({"title" = "ASC"})
//     */
//    private $nodeHandlers;

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    private $created;

    /**
     * @ORM\Column(name="modified", type="datetime_immutable", nullable=true)
     */
    private $modified;

    /**
     * Node constructor
     *
     * @param Id $id
     * @param NodeTitle $title
     * @param DateTimeImmutable $created
     * @param Process $process
     * @param Position $position
     */
    public function __construct(
        Id $id,
        NodeTitle $title,
        DateTimeImmutable $created,
        Process $process,
        Position $position
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->position = $position;
        $this->process = $process;
        $this->created = $created;
        $this->modified = null;

        $this->nodeFields = new ArrayCollection();
//        $this->nodeHandlers = new ArrayCollection();
    }

    public static function create(int $id, string $title, Process $process, Position $position): self
    {
        return new self(
            new NodeId($id),
            new NodeTitle($title),
            new DateTimeImmutable('now'),
            $process,
            $position
        );
    }

    public function setGroup(Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param string $title
     * @param FieldInterface $field
     * @throws Exception
     */
    public function addField(string $title, FieldInterface $field): void
    {
        $this->nodeFields->add(new NodeField($title, $this, $field));
    }

//    public function addNodeField(NodeField $nodeField): void
//    {
//        $this->nodeFields->add($nodeField);
//    }

//    public function addNodeHandler(NodeHandler $nodeHandler): void
//    {
//        $this->nodeHandlers->add($nodeHandler);
//    }

    public function assignGroup(Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function move(Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getModified(): ?DateTimeImmutable
    {
        return $this->modified;
    }

    public function getProcess(): Process
    {
        return $this->process;
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function getNodeFields(): ArrayCollection
    {
        return $this->nodeFields;
    }

//    public function getNodeHandlers(): ArrayCollection
//    {
//        return $this->nodeHandlers;
//    }


}