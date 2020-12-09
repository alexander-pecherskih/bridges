<?php

namespace App\Model\Process\Entity\Process;

use App\Model\Process\Entity\Node\Node;
use App\Model\Stuff\Entity\Employee\Employee;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DomainException;
use Exception;
use Symfony\Component\Serializer\Annotation as Serializer;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="process")
 */
class Process
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @Serializer\Groups({"process-view"})
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Stuff\Entity\Employee\Employee")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     * @Serializer\Groups({"process-view"})
     */
    private Employee $owner;

    /**
     * @ORM\Column(name="title", type="string", nullable=false)
     * @Serializer\Groups({"process-view"})
     */
    private string $title;

    /**
     * @Serializer\Groups({"process-view"})
     */
    private ?UuidInterface $startNodeId = null;

    /**
     * @var Collection|Node[] $nodes
     *
     * @ORM\OneToMany(targetEntity="App\Model\Process\Entity\Node\Node", mappedBy="process")
     * @ORM\OrderBy({"title" = "ASC"})
     * @Serializer\Groups({"process-view"})
     */
    private Collection $nodes;

    /**
     * @var Collection|Route[] $routes
     *
     * @ORM\OneToMany(targetEntity="Route", mappedBy="process", orphanRemoval=true, cascade={"all"})
     * @Serializer\Groups({"process-view"})
     */
    private Collection $routes;

    public function __construct(UuidInterface $id, DateTimeImmutable $created, Employee $owner, string $title)
    {
        $this->id = $id;
        $this->created = $created;
        $this->owner = $owner;
        $this->title = $title;

        $this->nodes = new ArrayCollection();
        $this->routes = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getOwner(): Employee
    {
        return $this->owner;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStartNodeId(): ?UuidInterface
    {
        return $this->startNodeId;
    }

    public function rename(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param Node $node
     */
    public function setStartNodeId(Node $node): void
    {
        if ($node->getProcess()->getId() !== $this->id) {
            throw new DomainException('The Node does not belong to this Process');
        }

        $this->startNodeId = $node->getId();
    }

    public function setOwner(Employee $owner): void
    {
        $this->owner = $owner;
    }

    public function getNodes(): Collection
    {
        return $this->nodes;
    }

    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    /**
     * @param Node $source
     * @param Node $target
     * @throws Exception
     */
    public function addRoute(Node $source, Node $target): void
    {
        $route = new Route(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $this,
            $source,
            $target
        );

        $this->routes->add($route);
    }

    /**
     * @param UuidInterface $routeId
     */
    public function removeRoute(UuidInterface $routeId): void
    {
        foreach ($this->routes as $route) {
            if ($route->getId() === $routeId) {
                $this->routes->removeElement($route);
                return;
            }
        }

        throw new DomainException('Route is not found.');
    }
}
