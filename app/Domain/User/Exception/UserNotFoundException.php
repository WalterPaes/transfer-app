<?php

namespace App\Domain\User\Exception;

/**
 * Class UserNotFoundException
 * @package App\Domain\User\Exception
 */
class UserNotFoundException extends \DomainException
{
    /**
     * UserNotFoundException constructor.
     * @param int $id
     * @param string $email
     */
    public function __construct(int $id, string $email = '')
    {
        $message = "User of %s '%v' not found";
        $code = 404;
        if (!empty($email)) {
            parent::__construct(sprintf($message, ['email', $email]), $code);
        }
        parent::__construct(sprintf($message, ['id', $id]), $code);
    }
}
