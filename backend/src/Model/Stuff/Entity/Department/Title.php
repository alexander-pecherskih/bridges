<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Department;

use Webmozart\Assert\Assert;

class Title
{
    /**
     * @var string
     */
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value, 'Department title is empty');
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
