<?php

namespace App\Model\Process\Entity\Process;

use App\Model\Process\Entity\Node\Node;
use DateTimeImmutable;
use DomainException;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="routes")
 */
class Route
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     * @Serializer\Groups({"process-view"})
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Process\Entity\Process\Process", inversedBy="routes")
     * @ORM\JoinColumn(name="process_id", referencedColumnName="id", nullable=false)
     */
    private Process $process;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Process\Entity\Node\Node", inversedBy="routes")
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id", nullable=false)
     */
    private Node $source;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Process\Entity\Node\Node")
     * @ORM\JoinColumn(name="target_id", referencedColumnName="id", nullable=false)
     */
    private Node $target;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Process $process,
        Node $source,
        Node $target
    ) {
        if ($process->getId() !== $source->getProcess()->getId()) {
            throw new DomainException('Invalid source node process id');
        }

        if ($process->getId() !== $target->getProcess()->getId()) {
            throw new DomainException('invalid target node process id');
        }

        $this->id = $id;
        $this->created = $created;
        $this->process = $process;
        $this->source = $source;
        $this->target = $target;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @Serializer\SerializedName("source_id")
     * @Serializer\Groups({"process-view"})
     */
    public function getSourceId(): UuidInterface
    {
        return $this->source->getId();
    }

    /**
     * @Serializer\SerializedName("target_id")
     * @Serializer\Groups({"process-view"})
     */
    public function getTargetId(): UuidInterface
    {
        return $this->target->getId();
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }
}
