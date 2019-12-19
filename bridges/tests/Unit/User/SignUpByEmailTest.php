<?php

namespace App\Tests\Unit\User;

use PHPUnit\Framework\TestCase;
use App\Model\User\Entity\User;
use DateTimeImmutable;

class SignUpByEmailTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User\User::signUpByEmail(
            $id = new User\Id(1),
            $created = new DateTimeImmutable(),
            $name = new User\Name('first', 'last', 'patronymic'),
            $email = new User\Email('test@bridges.ru'),
            $hash = 'hash',
            $token = 'token'
        );


        self::assertEquals($id, $user->getId());
        self::assertEquals($created, $user->getCreated());
        self::assertEquals($name, $user->getName());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($token, $user->getConfirmToken());

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertTrue($user->getRole()->isUser());
    }
}