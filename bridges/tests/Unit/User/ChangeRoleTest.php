<?php


namespace App\Tests\Unit\User;


use App\Model\User\Entity\User\Role;
use App\Tests\Builder\UserBuilder;
use PHPUnit\Framework\TestCase;

class ChangeRoleTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->withEmail()->build();

        $user->changeRole(Role::admin());

        self::assertFalse($user->getRole()->isUser());
        self::assertTrue($user->getRole()->isAdmin());
    }

    public function testAlready(): void
    {
        $user = (new UserBuilder())->withEmail()->build();

        self::expectExceptionMessage('Role is already same');
        $user->changeRole(Role::user());
    }
}