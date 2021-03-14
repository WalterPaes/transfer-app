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
     */
    public function __construct(int $id)
    {
        parent::__construct("The user of id '{$id}' not found", 404);
    }
}
