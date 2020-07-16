<?php

namespace App\Tests\Builder\Builder\Stuff;

use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Department\Department;
use App\Model\Stuff\Entity\Department\Title;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class DepartmentBuilder
{
    private UuidInterface $id;
    private DateTimeImmutable $created;
    private ?DateTimeImmutable $modified;
    private string $title;
    private Department $parent;
    private Company $company;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        string $title,
        Company $company,
        Department $parent = null
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->title = new Title($title);
        $this->company = $company;
        $this->parent = $parent;
        $this->modified = null;
    }

    public function withCompany(Company $company): self
    {
        $clone = clone $this;
        $clone->company = $company;
        return $clone;
    }

    public function withParent(Department $parent): self
    {
        $clone = clone $this;
        $clone->parent = $parent;
        return $clone;
    }

    public function build(): Department
    {
        return new Department(
            $this->id,
            $this->created,
            $this->company,
            $this->title,
            $this->parent
        );
    }
}
