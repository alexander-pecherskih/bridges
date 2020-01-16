<?php


namespace App\Model\User\Entity\User;


use Webmozart\Assert\Assert;

class Email
{
    private $value;

    public function __construct($value)
    {
        Assert::notEmpty($value);
        Assert::email($value);

        $this->value = mb_strtolower($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}