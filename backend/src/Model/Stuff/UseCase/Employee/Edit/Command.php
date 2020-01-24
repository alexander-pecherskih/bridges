<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Edit;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /** @Assert\NotBlank() */
    public string $id;

    /** @Assert\NotBlank() */
    public string $firstName;

    /** @Assert\NotBlank() */
    public string $lastName;

    public string $patronymic;

    /**
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    public string $email;

    /** @Assert\NotBlank() */
    public string $position;
}
