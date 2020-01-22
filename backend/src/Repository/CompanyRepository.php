<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\EntityNotFoundException;
use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Company\CompanyRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Ramsey\Uuid\UuidInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Company::class);
    }

    /**
     * @param UuidInterface $id
     * @return Company
     */
    public function get(UuidInterface $id): Company
    {
        /** @var Company $company */
        $company = $this->repository->find($id);

        if (!$company) {
            throw new EntityNotFoundException('User is not found');
        }

        return $company;
    }

    public function add(Company $company): void
    {
        $this->em->persist($company);
    }

    public function remove(Company $company): void
    {
        $this->em->remove($company);
    }
}
