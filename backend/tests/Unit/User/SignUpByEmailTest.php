<?php

namespace App\Tests\Unit\User;

use App\Model\User\Entity\User;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;

class SignUpByEmailTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $user = User\User::signUpByEmail(
            $id = UserRepository::nextId(),
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
