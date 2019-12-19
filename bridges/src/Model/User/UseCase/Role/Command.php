<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Role;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var int
     * @Assert\Num
     */
    public $id;

    /**
     * @var string
     */
    public $role;
}
