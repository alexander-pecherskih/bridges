<?php


namespace App\Tests\Builder;


use App\Model\Process\Entity\Process\Process;
use App\Model\Process\Entity\Process\Title;
use App\Model\User\Entity\User\User;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProcessBuilder
{
    private $id;
    private $created;
    private $title;
    private $owner;

    /**
     * ProcessBuilder constructor.
     * @param UuidInterface|null $id
     * @param DateTimeImmutable|null $created
     * @param User|null $owner
     * @param string $title
     * @throws Exception
     */
    public function __construct(
        UuidInterface $id = null,
        DateTimeImmutable $created = null,
        User $owner = null,
        string $title = 'Process'
    ) {
        $this->id = $id ?? Uuid::uuid4();
        $this->title = new Title($title ?? 'Process');
        $this->created = $created ?? new DateTimeImmutable();
        $this->owner = $owner ?? (new UserBuilder())->withEmail()->build();
    }

    public function withCreated(DateTimeImmutable $created): self
    {
        $clone = clone $this;
        $clone->created = $created;
        return $clone;
    }

    public function withOwner(User $owner): self
    {
        $clone = clone $this;
        $clone->owner = $owner;
        return $clone;
    }

    public function withTitle(string $title): self
    {
        $clone = clone $this;
        $clone->title = new Title($title);;
        return $clone;
    }

    /**
     * @return Process
     * @throws Exception
     */
    public function build(): Process
    {
        return new Process($this->id, $this->created, $this->title, $this->owner);
    }
}