<?php

declare(strict_types=1);

namespace App\Model\Process\Entity\Field;

interface FieldInterface
{
    public function getName(): string;

    public function getConstraints(): array;
}
