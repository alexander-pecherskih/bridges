<?php

declare(strict_types=1);

namespace App\ReadModel\User;

class AuthUser
{
    public string $id;
    public string $username;
    public string $password;
    public string $name;
    public string $role;
    public string $status;
}
