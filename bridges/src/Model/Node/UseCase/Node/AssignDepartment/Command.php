<?php

declare(strict_types=1);

namespace App\Model\Node\UseCase\Node\AssignDepartment;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $departmentId;
}
