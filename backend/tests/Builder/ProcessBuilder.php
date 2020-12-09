<?php

namespace App\Tests\Builder;

use App\Model\Process\Entity\Process\Process;
use App\Model\Stuff\Entity\Employee\Employee;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\Stuff\EmployeeBuilder;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProcessBuilder
{
    private UuidInterface $id;
    private DateTimeImmutable $created;
    private string $title;
    private Employee $owner;

    /**
     * ProcessBuilder constructor.
     * @param UuidInterface|null $id
     * @param DateTimeImmutable|null $created
     * @param Employee|null $owner
     * @param string $title
     * @throws Exception
     */
    public function __construct(
        UuidInterface $id = null,
        DateTimeImmutable $created = null,
        Employee $owner = null,
        string $title = 'Process'
    ) {
        $this->id = $id ?? Uuid::uuid4();
        $this->created = $created ?? new DateTimeImmutable();
        $this->owner = $owner ?? (new EmployeeBuilder())->build();
        $this->title = $title ?? 'Process';
    }

    public function withCreated(DateTimeImmutable $created): self
    {
        $clone = clone $this;
        $clone->created = $created;
        return $clone;
    }

    public function withOwner(Employee $owner): self
    {
        $clone = clone $this;
        $clone->owner = $owner;
        return $clone;
    }

    public function withTitle(string $title): self
    {
        $clone = clone $this;
        $clone->title = $title;
        return $clone;
    }

    /**
     * @return Process
     * @throws Exception
     */
    public function build(): Process
    {
        return new Process($this->id, $this->created, $this->owner, $this->title);
    }
}
