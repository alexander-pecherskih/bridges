<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Department;

use App\Model\Stuff\Entity\Company\Company;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DomainException;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation as Serializer;


/**
 * @property UuidInterface $id
 * @property DateTimeImmutable $created
 * @property DateTimeImmutable $modified
 * @property string $title
 * @property Department $parent
 * @property Company $company
 * @property Collection $children
 *
 * @ORM\Entity
 * @ORM\Table(name="departments")
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @Serializer\Groups({"process-view"})
     */
    private UuidInterface $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private DateTimeImmutable $created;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $modified;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private string $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Stuff\Entity\Company\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    public Company $company;

    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Department $parent;

    /**
     * @var Collection|Department[]
     *
     * @ORM\OneToMany( targetEntity="Department", mappedBy="parent")
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private Collection $children;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Company $company,
        string $title,
        Department $parent = null
    ) {
        $this->id = $id;
        $this->created = $created;
        $this->modified = null;
        $this->company = $company;
        $this->title = $title;
        $this->parent = $parent;

        $this->children = new ArrayCollection();
    }

    public function rename(string $title): void
    {
        $this->title = $title;
    }

    public function move(Department $parent): void
    {
        if ($this->parent === $parent) {
            throw new DomainException('Parent already set');
        }

        if ($this->parent === $this) {
            throw new DomainException('Object cannot be parent');
        }

        if ($this->company !== $parent->company) {
            throw new DomainException('Wrong Company');
        }

        $this->parent = $parent;
    }

    public function addChild(Department $parent): void
    {
        $this->children->add($parent);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getModified(): ?DateTimeImmutable
    {
        return $this->modified;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getParent(): ?Department
    {
        return $this->parent;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }
}
