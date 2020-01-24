<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Node\AssignDepartment;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $id;

    /**
     * @Assert\NotBlank()
     */
    public string $departmentId;
}
