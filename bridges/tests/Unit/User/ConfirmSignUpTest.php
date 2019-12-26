<?php


namespace App\Tests\Unit\User;


use App\Model\User\Entity\User;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;

class ConfirmSignUpTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testConfirm(): void
    {
        $user = User\User::signUpByEmail(
            $id = User\UserRepository::nextId(),
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

    /**
     * @throws Exception
     */
    public function testAlready(): void
    {
        $user = User\User::signUpByEmail(
            $id = User\UserRepository::nextId(),
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