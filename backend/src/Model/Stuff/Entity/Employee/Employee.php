<?php

namespace App\Model\Stuff\Entity\Employee;

use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Department\Department;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property DateTimeImmutable $created
 * @property Name $name
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
     */
    public $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(name="created", type="datetime_immutable")
     */
    public $created;

    /**
     * @var Name
     * @ORM\Embedded(class="Name", columnPrefix="name_")
     */
    public $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    public $position;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    public $company;

    /**
     * @var Department
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    public $department;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Company $company,
        Name $name,
        string $position = ''
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->company = $company;
        $this->name = $name;
        $this->position = $position;
    }

    public function assignDepartment(Department $department): void
    {
        $this->department = $department;
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
