<?php

namespace App\Model\Stuff\Entity\Employee;

use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Department\Department;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @property UuidInterface $id
 * @property DateTimeImmutable $created
 * @property Name $name
 * @property Email $email
 * @property string $position
 * @property Company $company
 * @property Department $department
 *
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class Employee
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @Serializer\Groups({"process-view"})
     */
    public UuidInterface $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(name="created", type="datetime_immutable")
     */
    public DateTimeImmutable $created;

    /**
     * @ORM\Embedded(class="Name", columnPrefix="name_")
     * @Serializer\Groups({"process-view"})
     */
    public Name $name;

    /**
     * @ORM\Column(type="employee_email", unique=false, nullable=true)
     */
    private Email $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    public string $position;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="App\Model\Stuff\Entity\Company\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    public Company $company;

    /**
     * @var Department
     * @ORM\ManyToOne(targetEntity="App\Model\Stuff\Entity\Department\Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    public Department $department;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Company $company,
        Name $name,
        Email $email,
        string $position = ''
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->company = $company;
        $this->name = $name;
        $this->email = $email;
        $this->position = $position;
    }

    public function assignDepartment(Department $department): void
    {
        $this->department = $department;
    }

    public function edit(Name $name, Email $email, string $position): void
    {
        $this->name = $name;
        $this->email = $email;
        $this->position = $position;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }
}
