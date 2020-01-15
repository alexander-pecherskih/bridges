<?php

namespace App\Model\User\UseCase\SignUp\Confirm;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}