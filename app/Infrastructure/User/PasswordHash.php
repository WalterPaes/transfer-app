<?php

namespace App\Infrastructure\User;

use App\Domain\User\PasswordEncrypt;

/**
 * Class PasswordHash
 * @package App\Infrastructure\User
 */
class PasswordHash implements PasswordEncrypt
{
    /**
     * @param string $password
     * @return string
     */
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }
}
