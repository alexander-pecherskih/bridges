<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Company\Remove;

use App\Model\Flusher;
use App\Model\Stuff\Entity\Company\CompanyRepositoryInterface;
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

    public function handle(Command $command): void
    {
        $company = $this->companyRepository->get(Uuid::fromString($command->id));

        $this->companyRepository->remove($company);

        $this->flusher->flush();
    }
}
