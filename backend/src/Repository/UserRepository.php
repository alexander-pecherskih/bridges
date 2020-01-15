<?php

namespace App\Repository;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepositoryInterface;
use Doctrine\ORM;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserRepository implements UserRepositoryInterface
{
    private $em;
    /** @var ORM\EntityRepository */
    private $repo;

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
        if (!$user = $this->repo->findOneBy(['id' => $id])) {
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
        if ( !$user = $this->repo->findOneBy(['resetToken.token' => $token])) {
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
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.email = :email')
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
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->innerJoin('t.networks', 'n')
                ->andWhere('n.network = :network and n.identity = :identity')
                ->setParameter(':network', $network)
                ->setParameter(':identity', $identity)
                ->getQuery()->getSingleScalarResult() > 0;
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
