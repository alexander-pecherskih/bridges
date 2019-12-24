<?php


namespace App\Tests\Builder;


use App\Model\Node\Entity\Node\Node;
use App\Model\Node\Entity\Node\Position;
use App\Model\Node\Entity\Node\Title;
use App\Model\Process\Entity\Process\Process;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class NodeBuilder
{
    /**
     * @var UuidInterface
     */
    private $id;
    private $title;
    private $created;
    private $process;
    private $position;

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
        $this->title = new Title($title ?? 'Node');
        $this->created = $created ?? new DateTimeImmutable();
        $this->process = $process ?? (new ProcessBuilder())->build((new UserBuilder())->build());
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