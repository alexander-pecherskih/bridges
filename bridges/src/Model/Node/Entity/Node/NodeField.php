<?php


namespace App\Model\Node\Entity\Node;


use App\Model\Node\Entity\Field\FieldInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;
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
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @var Node
     *
     * @ORM\ManyToOne(targetEntity="Node", inversedBy="nodeFields")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id", nullable=false)
     */
    private $node;

    /**
     * @var FieldInterface
     */
    private $field;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private $created;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $modified;

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