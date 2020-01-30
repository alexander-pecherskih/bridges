<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Process\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $title;

    /**
     * @Assert\NotBlank()
     */
    public string $userId;
}
