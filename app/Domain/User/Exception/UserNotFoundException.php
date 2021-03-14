<?php

namespace App\Domain\User\Exception;

class UserNotFoundException extends \DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("The user of id '{$id}' not found", 404);
    }
}
