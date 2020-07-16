<?php

namespace App\Tests\Builder\Stuff;

use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Employee\Email;
use App\Model\Stuff\Entity\Employee\Employee;
use App\Model\Stuff\Entity\Employee\Name;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use DateTimeImmutable;
use Exception;

class EmployeeBuilder
{
    private UuidInterface $id;
    private DateTimeImmutable $created;
    private Company $company;
    private Name $name;
    private Email $email;
    private string $position;

    /**
     * EmployeeBuilder constructor.
     * @param UuidInterface|null $id
     * @param Name|null $name
     * @param Email|null $email
     * @throws Exception
     */
    public function __construct(
        UuidInterface $id = null,
        Name $name = null,
        Email $email = null
    ) {
        $this->id = $id ?? Uuid::uuid4();
        $this->created = new DateTimeImmutable();
        $this->name = $name ?? new Name('First', 'Last', 'Patronymic');
        $this->email = $email ?? new Email('employee@domain.com');

        $this->company = new Company(Uuid::uuid4(), new DateTimeImmutable(), 'Company');
        $this->position = 'Position';
    }

    public function withCompany(Company $company): self
    {
        $clone = clone $this;
        $clone->company = $company;
        return $clone;
    }

    public function withPosition(string $position): self
    {
        $clone = clone $this;
        $clone->position = $position;
        return $clone;
    }

    public function build(): Employee
    {
        return new Employee(
            $this->id,
            $this->created,
            $this->company,
            $this->name,
            $this->email,
            $this->position
        );
    }
}
