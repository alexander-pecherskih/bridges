<?php

declare(strict_types=1);

namespace App\Model\Process\Entity\Field;

class ReferenceField implements FieldInterface
{
    public function getName(): string
    {
        return 'Reference';
    }

    public function getConstraints(): array
    {
//        Assert::notEmpty($this->value, 'Trololo empty int');
//        Assert::integer($this->value, 'Trololo int');

        // TODO: Implement getAsserts() method.
        return [];
    }
}
