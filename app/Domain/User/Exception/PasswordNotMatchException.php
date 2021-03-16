<?php

namespace App\Domain\User\Exception;

/**
 * Class PasswordNotMatchException
 * @package App\Domain\User\Exception
 */
class PasswordNotMatchException extends \InvalidArgumentException
{
    /**
     * PasswordNotMatchException constructor.
     */
    public function __construct()
    {
        parent::__construct("Password not match", 401);
    }
}
