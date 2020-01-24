<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Company\Create;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Company\Company;
use App\Model\Stuff\Entity\Company\CompanyRepositoryInterface;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;

class Handler
{
    private CompanyRepositoryInterface $companyRepository;
    private Flusher $flusher;

    public function __construct(CompanyRepositoryInterface $companyRepository, Flusher $flusher)
    {
        $this->companyRepository = $companyRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @throws Exception
     */
    public function handle(Command $command): void
    {
        $company = new Company(Uuid::uuid4(), new DateTimeImmutable(), $command->title);

        $this->companyRepository->add($company);

        $this->flusher->flush();
    }
}
