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

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function check(string $password, string $hash): bool;
}
