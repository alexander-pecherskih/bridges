<?php


namespace Unit\Stuff;


use App\Model\Stuff\Entity\Company\Company;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use DateTimeImmutable;

class CreateCompanyTest extends TestCase
{
    public function testSuccess(): void
    {
        $company = new Company(
            $id = Uuid::uuid4(),
            $created = new DateTimeImmutable(),
            $title = 'Company'
        );

        self::assertEquals($company->getId(), $id);
        self::assertEquals($company->getCreated(), $created);
        self::assertEquals($company->getTitle(), $title);
    }

    public function testEmpty(): void
    {
        $this->expectExceptionMessage('Company title is empty');
        $company = new Company(Uuid::uuid4(), new DateTimeImmutable(),'');
    }
}