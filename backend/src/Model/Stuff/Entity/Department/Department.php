<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Department;

use App\Model\Stuff\Entity\Company\Company;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property DateTimeImmutable $created
 * @property DateTimeImmutable $modified
 * @property Title $title
 * @property Department $parent
 * @property Company $company
 * @property ArrayCollection $children
 *
 * @ORM\Entity
 * @ORM\Table(name="departments")
 */
class Department
{
    /**
     * @var UuidInterface
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidInterface $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private DateTimeImmutable $created;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private DateTimeImmutable $modified;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $title;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    public $company;

    /**
     * @var Department
     * @ORM\ManyToOne( targetEntity="Department", inversedBy="children" )
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var ArrayCollection|Department[]
     *
     * @ORM\OneToMany( targetEntity="Department", mappedBy="parent")
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private $children;

    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        Company $company,
        Title $title,
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

    public function setParent(Department $parent): void
    {
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

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getParent(): ?Department
    {
        return $this->parent;
    }

    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }
}
