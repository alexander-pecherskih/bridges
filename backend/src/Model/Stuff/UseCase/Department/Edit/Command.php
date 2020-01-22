<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Department\Edit;

use App\Model\Stuff\Entity\Department\Department;

class Command
{
    public string $id;
    public string $title;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
