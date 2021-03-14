<?php

namespace App\Domain\User;

interface PasswordEncrypt
{
    public function encrypt(string $password): string;
}