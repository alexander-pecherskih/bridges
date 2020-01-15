<?php


namespace App\Model\Stuff\Entity\Department;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\UuidInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param UuidInterface $id
     * @return Department
     * @throws EntityNotFoundException
     */
    public function get(UuidInterface $id): Department
    {
        /** @var Department $department */
        $department = $this->em->getRepository(Department::class)->find($id);

        if ( !$department ) {
            throw new EntityNotFoundException('User is not found.');
        }

        return $department;
    }

    public function add(Department $department): void
    {
        $this->em->persist($department);
        $this->em->flush();
    }
}