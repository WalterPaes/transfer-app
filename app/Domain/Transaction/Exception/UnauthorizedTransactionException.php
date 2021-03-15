<?php

namespace App\Domain\Transaction\Exception;

/**
 * Class UnauthorizedTransactionException
 * @package App\Domain\Transaction\Exception
 */
class UnauthorizedTransactionException extends \Exception
{
    /**
     * UnauthorizedTransactionException constructor.
     */
    public function __construct()
    {
        parent::__construct("Transaction Unauthorized", 401);
    }
}
