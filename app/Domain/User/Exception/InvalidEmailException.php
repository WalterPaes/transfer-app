<?php

namespace App\Domain\User\Exception;

use Throwable;

class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct(string $email)
    {
        parent::__construct("Email '{$email}' is invalid");
    }
}
