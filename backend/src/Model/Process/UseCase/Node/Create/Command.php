<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Node\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $title;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    public int $top;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    public int $left;

    /**
     * @Assert\NotBlank()
     */
    public string $processId;
}
