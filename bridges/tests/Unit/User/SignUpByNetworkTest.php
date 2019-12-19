<?php


namespace App\Tests\Unit\User;

use App\Model\User\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class SignUpByNetworkTest extends TestCase
{
    public function testAuth(): void
    {
        $user = User\User::signUpByNetwork(
            $id = new User\Id(1),
            $created = new DateTimeImmutable(),
            $name = new User\Name('first', 'last', 'patronymic'),
            $networkName = 'network',
            $identity = 'identity'
        );

        self::assertTrue($user->isActive());
        self::assertEquals($id, $user->getId());
        self::assertEquals($created, $user->getCreated());
        self::assertEquals($name, $user->getName());
        self::assertTrue($user->getRole()->isUser());

        self::assertCount(1, $networks = $user->getNetworks());
        self::assertInstanceOf(User\Network::class, $network = reset($networks));
        self::assertEquals($networkName, $network->getName());
        self::assertEquals($identity, $network->getIdentity());
    }
}