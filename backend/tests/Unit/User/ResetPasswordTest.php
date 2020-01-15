<?php


namespace App\Tests\Unit\User;


use App\Model\User\Entity\User\ResetToken;
use App\Tests\Builder\UserBuilder;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;

class ResetPasswordTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->withEmail()->confirmed()->build();

        $now = new DateTimeImmutable();

        $user->requestPasswordReset(new ResetToken($token = 'token', $now), $now);
        self::assertNotNull($user->getResetToken());

        $user->resetPassword($hash = 'hash', $now);

        self::assertEquals($hash, $user->getPasswordHash());
        self::assertNull($user->getResetToken());

    }

    /**
     * @throws Exception
     */
    public function testExpired(): void
    {
        $user = (new UserBuilder())->withEmail()->confirmed()->build();
        $now = new DateTimeImmutable();
        $user->requestPasswordReset(new ResetToken($token = 'token', $now), $now);

        self::expectExceptionMessage('Reset token is expired');
        $user->resetPassword($hash = 'hash', $now->modify('+3 days'));
    }

    /**
     * @throws Exception
     */
    public function testNoRequested(): void
    {
        $user = (new UserBuilder())->withEmail()->confirmed()->build();

        self::expectExceptionMessage('Resetting password not requested');
        $user->resetPassword($hash = 'hash', new DateTimeImmutable());
    }
}