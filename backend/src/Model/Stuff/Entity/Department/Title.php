<?php


namespace App\Model\Stuff\Entity\Department;


use Webmozart\Assert\Assert;

class Title
{
    /**
     * @var string
     */
    private $value;

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