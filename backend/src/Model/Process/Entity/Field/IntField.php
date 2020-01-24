<?php

namespace App\Model\Process\Entity\Field;

class IntField implements FieldInterface
{
    private Value $value;

    public function __construct(Value $value)
    {
        $this->value = $value;
    }

    public function getConstraints(): array
    {
//        Assert::notEmpty($this->value, 'Trololo empty int');
//        Assert::integer($this->value, 'Trololo int');

        // TODO: Implement getAsserts() method.
        return [];
    }
}
