<?php


namespace App\Model\Node\Entity\Node;


use InvalidArgumentException;
use Webmozart\Assert\Assert;

class NodeId
{
    private $value;

    public function __construct(int $value)
    {
        Assert::notEmpty($value);
        Assert::numeric($value);

        if ($value <= 0) {
            throw new InvalidArgumentException('Invalid NodeId given');
        }

        $this->value = $value;
    }

    public static function next(): self
    {
        return new self(NodeRepositoryInterface::nextId());
    }

    public function getValue(): int
    {
        return $this->value;
    }
}