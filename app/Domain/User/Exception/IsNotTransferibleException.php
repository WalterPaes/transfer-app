<?php

namespace App\Domain\User\Exception;

/**
 * Class IsNotTransferibleException
 * @package App\Domain\User\Exception
 */
class IsNotTransferibleException extends \Exception
{
    /**
     * IsNotTransferibleException constructor.
     */
    public function __construct()
    {
        parent::__construct("The user cannot do transfers", 403);
    }
}
