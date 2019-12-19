<?php


namespace App\Tests\Unit\User;


use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Model\User\Entity\User;

class ConfirmSignUpTest extends TestCase
{
    public function testConfirm(): void
    {
        $user = User\User::signUpByEmail(
            $id = new User\Id(1),
            $created = new DateTimeImmutable(),
            $name = new User\Name('first', 'last', 'patronymic'),
            $email = new User\Email('test@bridges.ru'),
            $hash = 'hash',
            $token = 'token'
        );

        $user->confirmSignUp();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());
        self::assertNull($user->getConfirmToken());
    }

    public function testAlready(): void
    {
        $user = User\User::signUpByEmail(
            $id = new User\Id(1),
            $created = new DateTimeImmutable(),
            $name = new User\Name('first', 'last', 'patronymic'),
            $email = new User\Email('test@bridges.ru'),
            $hash = 'hash',
            $token = 'token'
        );

        $user->confirmSignUp();
        $this->expectExceptionMessage('User is already confirmed');
        $user->confirmSignUp();
    }
}