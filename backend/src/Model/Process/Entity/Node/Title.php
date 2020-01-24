<?php

namespace App\Model\Process\Entity\Node;

use Webmozart\Assert\Assert;

class Title
{
    /**
     * @var string
     */
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
