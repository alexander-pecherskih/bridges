<?php

declare(strict_types=1);

namespace App\Tests\Functional\Profile;

use App\Model\User\Service\PasswordHasher;
use App\Tests\Builder\UserBuilder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class ProfileFixture extends Fixture
{
    public const USER_ID = '00000000-0000-0000-0000-100000000001';

    private PasswordHasher $hasher;

    public static function userCredentials(): array
    {
        return [
            'PHP_AUTH_USER' => 'profile-user@app.test',
            'PHP_AUTH_PW' => 'password',
        ];
    }

    public function __construct(PasswordHasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $user = (new UserBuilder(Uuid::fromString(self::USER_ID), 'Profile', 'User'))
            ->withEmail(
                'profile-user@app.test',
                $this->hasher->hash('password')
            )->confirmed()
            ->build();

        $user->attachNetwork('facebook', '1111');

        $manager->persist($user);

        $manager->flush();
    }
}
