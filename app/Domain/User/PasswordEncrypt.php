<?php

namespace App\Domain\User;

/**
 * Interface PasswordEncrypt
 * @package App\Domain\User
 */
interface PasswordEncrypt
{
    /**
     * @param string $password
     * @return string
     */
    public function encrypt(string $password): string;
}
