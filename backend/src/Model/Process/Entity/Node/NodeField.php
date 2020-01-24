<?php

namespace App\Model\Process\Entity\Node;

use App\Model\Node\Entity\Field\FieldInterface;
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
     * @param string $title
     * @param Node $node
     * @param FieldInterface $field
     * @throws Exception
     */
    public function __construct(string $title, Node $node, FieldInterface $field)
    {
        Assert::notEmpty($title, 'Title ... not be empty');

        $this->id = NodeFieldRepository::nextId();
        $this->title = $title;

        $this->node = $node;
        $this->field = $field;

        $this->created = new DateTimeImmutable('now');
        $this->modified = null;
    }
}
