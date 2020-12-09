<?php

namespace App\Model\Process\Entity\Node;

use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\Route;
use App\Model\Stuff\Entity\Department\Department;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="nodes")
 */
class Node
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     * @Serializer\Groups({"process-view", "node-view"})
     */
    private UuidInterface $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Process\Entity\Process\Process", inversedBy="nodes")
     * @ORM\JoinColumn(name="process_id", referencedColumnName="id")
     */
    private Process $process;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Stuff\Entity\Department\Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * @Serializer\MaxDepth(1)
     * @Serializer\Groups({"process-view"})
     */
    private ?Department $department;

    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private string $title;

    /**
     * @ORM\Embedded(class="Position", columnPrefix="position_")
     * @Serializer\Groups({"process-view"})
     */
    private Position $position;

    /**
     * @var Collection|Route[]
     * @ORM\OneToMany(targetEntity="App\Model\Process\Entity\Process\Route", mappedBy="source")
     */
    private Collection $routes;

    /**
     * @var Collection|NodeField[]
     * @ORM\OneToMany(targetEntity="App\Model\Process\Entity\Node\NodeField", mappedBy="node")
     */
    private Collection $nodeFields;

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\Column(name="modified", type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $modified = null;

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
        $this->modified = null;

        $this->routes = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getProcess(): Process
    {
        return $this->process;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getModified(): ?DateTimeImmutable
    {
        return $this->modified;
    }

    /**
     * @return Department|null
     * @Serializer\MaxDepth(1)
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function assignDepartment(Department $department): void
    {
        $this->department = $department;
        $this->modified = new DateTimeImmutable();
    }

    public function move(Position $position): void
    {
        $this->position = $position;
        $this->modified = new DateTimeImmutable();
    }

    public function rename(string $title): void
    {
        $this->title = $title;
    }

    public function getRoutes(): Collection
    {
        return $this->routes;
    }
}
