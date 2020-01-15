<?php


namespace App\Model\Stuff\Entity\Department;


use App\Model\User\Entity\User\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Group
 * @package App\Entity
 *
 * @property int $id
 * @property string $title
 * @property Department $parent
 * @property ArrayCollection $users
 * @property ArrayCollection $children
 * @property DateTimeImmutable $created
 * @property DateTimeImmutable $modified
 *
 * @ORM\Entity()
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $title;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Department",
     *     mappedBy="group", orphanRemoval=true, cascade={"all"}
     * )
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private $parent;

    /**
     * @var ArrayCollection|Department[]
     *
     * @ORM\OneToMany(
     *     targetEntity="Department",
     *     mappedBy="group", orphanRemoval=true, cascade={"all"}
     * )
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private $children;

    /**
     * @ORM\OneToMany(
     *     targetEntity="User",
     *     mappedBy="group", orphanRemoval=true, cascade={"all"}
     * )
     * @ORM\OrderBy({"email" = "ASC"})
     */
    private $users;

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    private $created;

    /**
     * @ORM\Column(name="modified", type="datetime_immutable", nullable=true)
     */
    private $modified;

    public function __construct(int $id, string $title, Department $parent = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->parent = $parent;
        $this->children = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->created = new DateTimeImmutable();
        $this->modified = null;
    }

    public function setParent(Department $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function addChild(Department $parent): self
    {
        $this->children->add($parent);

        return $this;
    }

    public function addUser(User $user): void
    {
        $this->users->add($user);
    }

    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getParent(): ?Department
    {
        return $this->parent;
    }

    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getModified(): ?DateTimeImmutable
    {
        return $this->modified;
    }
}