<?php


namespace App\DataFixtures;


use App\Model\User\Entity\User;
use App\Model\User\Service\PasswordHasher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;

class UsersFixture extends Fixture
{
    private $hasher;

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

        $manager->persist($requested);

        $confirmed = $this->createSignUpConfirmedByEmail(
            new User\Name('Confirmed', 'User'),
            new User\Email('confirmed@bridges.local'),
            $hash
        );

        $manager->persist($confirmed);

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
}