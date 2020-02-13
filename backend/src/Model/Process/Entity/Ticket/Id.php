<?php

namespace App\Model\Process\Entity\Ticket;

use Webmozart\Assert\Assert;

class Id
{
    private int $value;

    public function __construct(int $value)
    {
        Assert::notEmpty($value);
        Assert::numeric($value);
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}