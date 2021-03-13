<?php

namespace App\Infra\Encrypt;

use App\Domain\Encrypt\PasswordEncrypt;

class PasswordHash implements PasswordEncrypt
{
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
}