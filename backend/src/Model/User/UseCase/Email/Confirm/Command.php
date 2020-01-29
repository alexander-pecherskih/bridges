<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Email\Confirm;

class Command
{
    /**
     * @var string
     */
    public string $id;
    /**
     * @var string
     */
    public string $token;

    public function __construct(string $id, string $token)
    {
        $this->id = $id;
        $this->token = $token;
    }
}
