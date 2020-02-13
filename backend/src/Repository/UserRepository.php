<?php

namespace App\Repository;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepositoryInterface;
use Doctrine\ORM;
use Doctrine\Persistence\ObjectRepository;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    private ORM\EntityManagerInterface $em;
    private ObjectRepository $repo;

    public function __construct(ORM\EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(User::class);
    }

    /**
     * @return UuidInterface
     * @throws Exception
     */
    public static function nextId(): UuidInterface
    {
        return Uuid::uuid4();
    }

    /**
     * @param UuidInterface $id
     * @return User|object
     * @throws ORM\EntityNotFoundException
     */
    public function get(UuidInterface $id): User
    {
        if (!$user = $this->repo->find($id)) {
            throw new ORM\EntityNotFoundException('User is not found');
        }

        return $user;
    }

    /**
     * @param Email $email
     * @return User|object
     * @throws ORM\EntityNotFoundException
     */
    public function getByEmail(Email $email): User
    {
        if (!$user = $this->repo->findOneBy(['email' => $email->getValue()])) {
            throw new ORM\EntityNotFoundException('User is not found');
        }

        return $user;
    }

    /**
     * @param string $token
     * @return User|object
     * @throws ORM\EntityNotFoundException
     */
    public function getByResetToken(string $token): User
    {
        if (!($user = $this->repo->findOneBy(['resetToken.token' => $token]))) {
            throw new ORM\EntityNotFoundException('Incorrect or confirmed token');
        }

        return $user;
    }

    /**
     * @param Email $email
     * @return bool
     * @throws ORM\NoResultException
     * @throws ORM\NonUniqueResultException
     */
    public function hasByEmail(Email $email): bool
    {
        return $this->em->createQueryBuilder()
                ->select('COUNT(u.id)')
                ->from('User', 'u')
                ->andWhere('u.email = :email')
                ->setParameter(':email', $email->getValue())
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function add(User $user): void
    {
        $this->em->persist($user);
    }

    /**
     * @param string $token
     * @return User|object|null
     */
    public function findByConfirmToken(string $token): ?User
    {
        return $this->repo->findOneBy(['confirmToken' => $token]);
    }

    /**
     * @param string $network
     * @param string $identity
     * @return bool
     * @throws ORM\NoResultException
     * @throws ORM\NonUniqueResultException
     */
    public function hasByNetworkIdentity(string $network, string $identity): bool
    {
        return $this->em->createQueryBuilder()
                ->select('COUNT(u.id)')
                ->from('User', 'u')
                ->innerJoin('u.networks', 'n')
                ->andWhere('n.network = :network and n.identity = :identity')
                ->setParameter(':network', $network)
                ->setParameter(':identity', $identity)
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }
}
