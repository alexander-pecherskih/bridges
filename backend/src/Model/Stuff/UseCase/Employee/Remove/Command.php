<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Remove;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $id;
}
