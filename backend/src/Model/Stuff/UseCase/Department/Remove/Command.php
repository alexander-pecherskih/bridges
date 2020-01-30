<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Remove;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $id;
}
