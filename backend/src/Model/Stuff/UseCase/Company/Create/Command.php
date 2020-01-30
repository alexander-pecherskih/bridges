<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Company\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $title;
}
