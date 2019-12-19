<?php


namespace App\Model\User\Entity\User;


use InvalidArgumentException;
use Webmozart\Assert\Assert;

class Id
{
    private $value;

    public function __construct(int $value)
    {
        Assert::numeric($value);

        if ($value <= 0) {
            throw new InvalidArgumentException('Invalid UserId given');
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public static function next(): self
    {
        return new self(UserRepositoryInterface::nextId());
    }
}