<?php

namespace Unit\Stuff;

use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Department\Department;
use App\Model\Stuff\Entity\Department\Title;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateDepartmentTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSuccess(): void
    {
        $department = new Department(
            $id = Uuid::uuid4(),
            $created = new DateTimeImmutable(),
            $company = new Company(
                $companyId = Uuid::uuid4(),
                $companyCreated = new DateTimeImmutable(),
                $companyTitle = 'Company'
            ),
            new Title($title = 'Department')
        );

        self::assertEquals($department->getId(), $id);
        self::assertEquals($department->getCreated(), $created);
        self::assertEquals($department->getTitle()->getValue(), $title);
        self::assertNull($department->getParent());
        self::assertNull($department->getModified());

        $parent = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            $company,
            new Title('Root Department')
        );

        $department->move($parent);
        self::assertEquals($department->getParent(), $parent);

        self::expectExceptionMessage('Parent already set');
        $department->move($parent);

        self::expectExceptionMessage('Object cannot be parent');
        $department->move($department);

        $anotherParent = new Department(
            Uuid::uuid4(),
            new DateTimeImmutable(),
            new Company(Uuid::uuid4(), new DateTimeImmutable(), 'Company'),
            new Title('Root Department')
        );

        self::expectExceptionMessage('Wrong Company');
        $department->move($anotherParent);
    }
}
