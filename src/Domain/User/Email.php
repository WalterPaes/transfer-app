<?php

namespace App\Domain\User;

class Email
{
    private string $mail;

    public function __construct(string $mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('invalid email');
        }

        $this->mail = $mail;
    }

    public function __toString(): string
    {
        return $this->mail;
    }
}