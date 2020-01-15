<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Process\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @var integer
     * @Assert\NotBlank()
     */
    public $userId;
}
