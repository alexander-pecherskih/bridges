<?php

namespace App\Model\Process\Entity\Process;

use Webmozart\Assert\Assert;

class Title
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
