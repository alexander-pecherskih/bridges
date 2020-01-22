<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Webmozart\Assert\Assert;

class Role
{
    public const USER = 'ROLE_USER';
    public const ADMIN = 'ROLE_ADMIN';

    private $value;

    public function __construct(string $value)
    {
        Assert::oneOf($value, [
            self::USER,
            self::ADMIN,
        ]);

        $this->value = $value;
    }

    public static function user(): self
    {
        return new self(self::USER);
    }

    public static function admin(): self
    {
        return new self(self::ADMIN);
    }

    public function isUser(): bool
    {
        return $this->value === self::USER;
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ADMIN;
    }

    public function is(self $role): bool
    {
        return $this->getValue() === $role->getValue();
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
