<?php


namespace App\Model\Node\Entity\Node;


use Webmozart\Assert\Assert;

class NodeTitle
{
    private $value;

    public function __construct($value)
    {
        Assert::notEmpty($value, 'Node title ... not be empty');

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}