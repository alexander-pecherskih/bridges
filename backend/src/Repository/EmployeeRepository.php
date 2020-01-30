<?php

namespace App\Repository;

use App\Model\EntityNotFoundException;
use App\Model\Stuff\Entity\Employee\Employee;
use App\Model\Stuff\Entity\Employee\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Ramsey\Uuid\UuidInterface;

/**
 * @property EntityRepository $repo
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $this->em->getRepository(Employee::class);
    }

    /**
     * @param UuidInterface $id
     * @return Employee
     * @throws EntityNotFoundException
     */
    public function get(UuidInterface $id): Employee
    {
        /** @var Employee $employee */
        $employee = $this->repo->find($id);

        if (!$employee) {
            throw new EntityNotFoundException('Employee not found.');
        }

        return $employee;
    }

    public function add(Employee $employee): void
    {
        $this->em->persist($employee);
    }

    public function remove(Employee $employee): void
    {
        $this->em->remove($employee);
    }
}
