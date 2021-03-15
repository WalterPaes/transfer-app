<?php

namespace App\Domain\Wallet\Exceptions;

/**
 * Class InsufficientFundsException
 * @package App\Domain\Wallet\Exceptions
 */
class InsufficientFundsException extends \InvalidArgumentException
{
    /**
     * InsufficientFundsException constructor.
     */
    public function __construct()
    {
        parent::__construct('Insufficient Funds', 400);
    }
}
