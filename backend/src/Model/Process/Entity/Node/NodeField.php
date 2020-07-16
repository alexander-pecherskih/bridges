<?php

declare(strict_types=1);

namespace App\Model\Process\Entity\Node;

use App\Model\Process\Entity\Field\FieldInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

/**
 * Class NodeField
 * @package App\Entity\Node
 *
 * @ORM\Entity()
 */
class NodeField
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $title;

    /**
     * @ORM\ManyToOne(targetEntity="Node", inversedBy="nodeFields")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id", nullable=false)
     */
    private Node $node;

    /**
     * @ORM\Column(type="node_field", unique=false, nullable=false)
     */
    private FieldInterface $field;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $modified = null;

    /**
     * NodeField constructor.
     * @param UuidInterface $id
     * @param DateTimeImmutable $created
     * @param string $title
     * @param Node $node
     * @param FieldInterface $field
     */
    public function __construct(
        UuidInterface $id,
        DateTimeImmutable $created,
        string $title,
        Node $node,
        FieldInterface $field
    ) {
        Assert::notEmpty($title, 'Title ... not be empty');

        $this->id = $id;
        $this->created = $created;
        $this->title = $title;
        $this->node = $node;
        $this->field = $field;
        $this->modified = null;
    }

    public function getNode(): Node
    {
        return $this->node;
    }

    public function getField(): FieldInterface
    {
        return $this->field;
    }
}
