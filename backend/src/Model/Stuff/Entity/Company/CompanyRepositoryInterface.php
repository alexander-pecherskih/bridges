<?php

declare(strict_types=1);

namespace App\Model\Stuff\Entity\Company;

use App\Model\EntityNotFoundException;
use Ramsey\Uuid\UuidInterface;

interface CompanyRepositoryInterface
{
    /**
     * @param UuidInterface $id
     * @return Company
     * @throws EntityNotFoundException
     */
    public function get(UuidInterface $id): Company;

    public function add(Company $company): void;

    public function remove(Company $company): void;
}
