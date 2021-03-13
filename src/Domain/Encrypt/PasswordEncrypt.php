<?php

namespace App\Domain\Encrypt;

interface PasswordEncrypt
{
    public function encrypt(string $password): string;
}