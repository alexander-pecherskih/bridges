<?php

namespace App\Model\Process\Entity\Node;

use App\Model\Process\Entity\Process\Process;
use App\Model\Stuff\Entity\Department\Department;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Column(name="title", type="string", nullable=false)
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
     * @var DateTimeImmutable
     * @ORM\Column(name="modified", type="datetime_immutable", nullable=true)
     */
    private $modified;

    /**
     * Node constructor
     *
     * @param UuidInterface $id
     * @param DateTimeImmutable $created
     * @param Title $title
     * @param Process $process
     * @param Position $position
     */
    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Title $title,
        Process $process,
        Position $position
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->position = $position;
        $this->process = $process;
        $this->created = $created;
        $this->modified = null;
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

    public function rename(Title $title): void
    {
        $this->title = $title;
    }
}
