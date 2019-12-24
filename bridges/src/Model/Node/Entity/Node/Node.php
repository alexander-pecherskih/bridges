<?php


namespace App\Model\Node\Entity\Node;


use App\Model\Node\Entity\Field\FieldInterface;
use App\Model\Process\Entity\Process\Process;
use App\Model\Stuff\Entity\Department\Department;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Model\Node\Entity\Node\NodeTitle;
use Ramsey\Uuid\UuidInterface;

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
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @var Process
     * @ORM\ManyToOne(targetEntity="Process")
     * @ORM\JoinColumn(name="process_id", referencedColumnName="id")
     */
    private $process;

    /**
     * @var Department
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;

    /**
     * @var Title
     * @ORM\Embedded(class="Title")
     */
    private $title;

    /**
     * @var Position
     * @ORM\Embedded(class="Position", columnPrefix="position_")
     */
    private $position;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    private $created;

    /**
     * Node constructor
     *
     * @param UuidInterface $id
     * @param DateTimeImmutable $created
     * @param string $title
     * @param Process $process
     * @param Position $position
     */
    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        string $title,
        Process $process,
        Position $position
    ) {


        $this->id = $id;
        $this->title = $title;
        $this->position = $position;
        $this->process = $process;
        $this->created = $created;

//        $this->nodeFields = new ArrayCollection();
//        $this->nodeHandlers = new ArrayCollection();
    }

    public static function create(UuidInterface $id, string $title, Process $process, Position $position): self
    {
        return new self(
            $id,
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

    public function getId(): UuidInterface
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

    public function getDepartment(): Department
    {
        return $this->department;
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