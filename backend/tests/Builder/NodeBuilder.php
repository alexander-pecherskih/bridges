<?php

namespace App\Tests\Builder;

use App\Model\Process\Entity\Node\Node;
use App\Model\Process\Entity\Node\Position;
use App\Model\Process\Entity\Process\Process;
use App\Model\Stuff\Entity\Employee\Employee;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\Stuff\EmployeeBuilder;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class NodeBuilder
{
    /**
     * @var UuidInterface
     */
    private UuidInterface $id;
    private string $title;
    private DateTimeImmutable $created;
    private Process $process;
    private Position $position;
    private Employee $owner;

    /**
     * NodeBuilder constructor.
     * @param UuidInterface|null $id
     * @param string|null $title
     * @param DateTimeImmutable|null $created
     * @param Process $process
     * @param Position $position
     * @throws Exception
     */
    public function __construct(
        UuidInterface $id = null,
        string $title = null,
        DateTimeImmutable $created = null,
        Process $process = null,
        Position $position = null
    ) {
        $this->id = $id ?? Uuid::uuid4();
        $this->title = $title ?? 'Node';
        $this->created = $created ?? new DateTimeImmutable();
        $this->process = $process ?? (new ProcessBuilder())->withOwner((new EmployeeBuilder())->build())->build();
        $this->position = $position ?? new Position(100, 100);
    }

    /**
     * @return Node
     * @throws Exception
     */
    public function build(): Node
    {
        return new Node($this->id, $this->created, $this->title, $this->process, $this->position);
    }
}
