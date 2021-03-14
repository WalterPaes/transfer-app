<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidEmailException;

class Email
{
    private string $mail;

    public function __construct(string $mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($mail);
        }
        $this->mail = $mail;
    }

    public function __toString(): string
    {
        return $this->mail;
    }
}
