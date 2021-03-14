<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidEmailException;

/**
 * Class Email
 * @package App\Domain\User
 */
class Email
{
    /**
     * @var string
     */
    private string $mail;

    /**
     * Email constructor.
     * @param string $mail
     */
    public function __construct(string $mail)
    {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($mail);
        }
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->mail;
    }
}
