<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Model\User\Entity\User;
use App\Model\User\Service\PasswordHasher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;

class UsersFixture extends Fixture implements DependentFixtureInterface
{
    public const REQUESTED_USER_REFERENCE = 'requested-bridges-local';
    public const CONFIRMED_USER_REFERENCE = 'confirmed-bridges-local';
    public const TROLOLO_USER_REFERENCE = 'trololo-bridges-local';

    private PasswordHasher $hasher;

    public function __construct(PasswordHasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $hash = $this->hasher->hash('password');

        $requested = $this->createSignUpRequestedByEmail(
            new User\Name('Requested', 'User'),
            new User\Email('requested@bridges.local'),
            $hash
        );

        $this->addReference(self::REQUESTED_USER_REFERENCE, $requested);

        $manager->persist($requested);

        $confirmed = $this->createSignUpConfirmedByEmail(
            new User\Name('Confirmed', 'User'),
            new User\Email('confirmed@bridges.local'),
            $hash
        );

        $this->addReference(self::CONFIRMED_USER_REFERENCE, $confirmed);

        $manager->persist($confirmed);

        $trololo = User\User::signUpByEmail(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            new User\Name('Trololo', 'User'),
            new User\Email('trololo@bridges.local'),
            $this->hasher->hash('password'),
            'secret_token'
        );
        $trololo->confirmSignUp();

        $this->addReference(self::TROLOLO_USER_REFERENCE, $trololo);

        $manager->persist($trololo);

        $manager->flush();
    }

    /**
     * @param User\Name $name
     * @param User\Email $email
     * @param $passwordHash
     * @return User\User
     * @throws Exception
     */
    private function createSignUpRequestedByEmail(User\Name $name, User\Email $email, $passwordHash): User\User
    {
        return User\User::signUpByEmail(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $name,
            $email,
            $passwordHash,
            'token'
        );
    }

    /**
     * @param User\Name $name
     * @param User\Email $email
     * @param string $hash
     * @return User\User
     * @throws Exception
     */
    private function createSignUpConfirmedByEmail(User\Name $name, User\Email $email, string $hash): User\User
    {
        $user = $this->createSignUpRequestedByEmail($name, $email, $hash);
        $user->confirmSignUp();
        return $user;
    }

    public function getDependencies(): array
    {
        return [
            OAuthFixture::class
        ];
    }
}
