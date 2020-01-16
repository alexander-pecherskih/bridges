<?php


namespace App\Model\Stuff\Entity\Company;


use Ramsey\Uuid\UuidInterface;

interface CompanyRepositoryInterface
{
    public function get(UuidInterface $id): Company;

    public function add(Company $company): void;
}