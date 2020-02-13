<?php

namespace App\DataFixtures;

use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Department\Department;
use App\Model\Stuff\Entity\Department\Title;
use App\Model\Stuff\Entity\Employee\Email;
use App\Model\Stuff\Entity\Employee\Employee;
use App\Model\Stuff\Entity\Employee\Name;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Exception;

class StuffFixture extends Fixture implements DependentFixtureInterface
{
    public const EMPLOYEE1_REFERENCE = 'employee1';
    public const EMPLOYEE2_REFERENCE = 'employee2';
    public const EMPLOYEE3_REFERENCE = 'employee3';

    public const DEPARTMENT1_REFERENCE = 'department1';
    public const DEPARTMENT2_REFERENCE = 'department2';
    public const DEPARTMENT3_REFERENCE = 'department3';

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $company1 = new Company(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Company 1'
        );

        $company2 = new Company(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            'Сбербанк'
        );

        $department1 = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            'sales'
        );

        $department2 = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            'wholesale',
            $department1
        );

        $department3 = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            'retail',
            $department1
        );

        $department4 = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            'Lightcab'
        );

        $department5 = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            'петухи',
            $department4
        );

        $department6 = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            'пидоры',
            $department4
        );

        $employee1 = new Employee(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            new Name('Иван', 'Иванов', 'Иванович'),
            new Email('invan@ivanov.ru'),
        'Босс'
        );

        $employee1->assignDepartment($department1);

        $employee2 = new Employee(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            new Name('Петр', 'Петров', 'Петрович'),
            new Email('petr@petrov.ru'),
        'Менеджер по продажам'
        );

        $employee2->assignDepartment($department2);

        $employee3 = new Employee(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company1,
            new Name('Сидор', 'Сидоров', 'Сидорович'),
            new Email('sidor@sidorov.ru'),
        'Менеджер по продажам'
        );

        $this->addReference(self::EMPLOYEE1_REFERENCE, $employee1);
        $this->addReference(self::EMPLOYEE2_REFERENCE, $employee2);
        $this->addReference(self::EMPLOYEE3_REFERENCE, $employee3);

        $this->addReference(self::DEPARTMENT1_REFERENCE, $department1);
        $this->addReference(self::DEPARTMENT2_REFERENCE, $department2);
        $this->addReference(self::DEPARTMENT3_REFERENCE, $department3);

        $employee3->assignDepartment($department3);

        $manager->persist($company1);
        $manager->persist($company2);
        $manager->persist($department1);
        $manager->persist($department2);
        $manager->persist($department3);
        $manager->persist($department4);
        $manager->persist($department5);
        $manager->persist($department6);
        $manager->persist($employee1);
        $manager->persist($employee2);
        $manager->persist($employee3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixture::class
        ];
    }
}
