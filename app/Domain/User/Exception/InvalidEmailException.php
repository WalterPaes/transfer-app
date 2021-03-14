<?php

namespace App\Domain\User\Exception;

/**
 * Class InvalidEmailException
 * @package App\Domain\User\Exception
 */
class InvalidEmailException extends \InvalidArgumentException
{
    /**
     * InvalidEmailException constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        parent::__construct("Email '{$email}' is invalid");
    }
}
