<?php

declare(strict_types=1);

namespace App\Model\Process\UseCase\Node\Create;

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
     * @Assert\GreaterThan(0)
     */
    public $top;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    public $left;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $processId;
}
