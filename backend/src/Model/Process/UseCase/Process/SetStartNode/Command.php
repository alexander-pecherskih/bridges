<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Process\SetStartNode;

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
    public string $nodeId;
}
