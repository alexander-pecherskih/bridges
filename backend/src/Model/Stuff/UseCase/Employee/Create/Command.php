<?php

declare(strict_types=1);

namespace App\Model\Stuff\UseCase\Employee\Create;

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
    public string $firstName;

    /**
     * @Assert\NotBlank()
     */
    public string $lastName;

    public string $patronymic;

    /**
     * @Assert\Email()
     */
    public string $email;

    /**
     * @Assert\NotBlank()
     */
    public string $position;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public string $companyId;

    /**
     * @var string
     */
    public string $departmentId;
}
