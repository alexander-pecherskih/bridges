<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Move;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $parent;

    public function __construct(string $id, string $parent)
    {
        $this->id = $id;
        $this->parent = $parent;
    }
}
