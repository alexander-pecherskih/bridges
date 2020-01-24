<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Move;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $departmentId;

    public function __construct(string $id, string $departmentId)
    {
        $this->id = $id;
        $this->departmentId = $departmentId;
    }
}
