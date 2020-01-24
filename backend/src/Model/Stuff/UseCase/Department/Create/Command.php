<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $title;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $company;

    /**
     * @var string
     */
    public string $parent;
}
