<?php

namespace App\Infra\User;

use App\Domain\User\PasswordEncrypt;

class PasswordHash implements PasswordEncrypt
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
}