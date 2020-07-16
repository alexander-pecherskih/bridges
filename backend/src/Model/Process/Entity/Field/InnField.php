<?php

namespace App\Model\Process\Entity\Field;

class InnField implements FieldInterface
{
    public function getName(): string
    {
        return 'INN';
    }

    public function getConstraints(): array
    {
//        Assert::notEmpty($this->value, 'Trololo empty int');
//        Assert::integer($this->value, 'Trololo int');

        // TODO: Implement getAsserts() method.
        return [];
    }
}
