<?php


namespace App\Model\Stuff\Entity\Department;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class DepartmentRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $id
     * @return Department
     * @throws EntityNotFoundException
     */
    public function get(int $id): Department
    {
        /** @var Department $group */
        $group = $this->em->getRepository(Department::class)->find($id);

        if ( !$group ) {
            throw new EntityNotFoundException('User is not found.');
        }

        return $group;
    }

    public function create(Department $group): void
    {
        $this->em->persist($group);
        $this->em->flush();
    }
}