<?php

namespace App\Tests\Unit\User;

use App\Model\User\Entity\User\ResetToken;
use App\Tests\Builder\UserBuilder;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;

class RequestPasswordResetTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->withEmail()->confirmed()->build();

        $now = new DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));

        $user->requestPasswordReset($token, $now);
        self::assertNotNull($user->getResetToken());

        $this->expectExceptionMessage('Resetting is already requested');
        $user->requestPasswordReset($token, $now);
    }

    /**
     * @throws Exception
     */
    public function testWithoutEmail(): void
    {
        $user = (new UserBuilder())->withNetwork()->build();

        $now = new DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 hour'));

        $this->expectExceptionMessage('Email is not specified');
        $user->requestPasswordReset($token, $now);
    }

    /**
     * @throws Exception
     */
    public function testInactive(): void
    {
        $user = (new UserBuilder())->withEmail()->build();

        $now = new DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 hour'));

        $this->expectExceptionMessage('User is not active');
        $user->requestPasswordReset($token, $now);
    }
}
