<?php

namespace App\Application\Services\Transaction\AuthorizeTransaction;

/**
 * Interface TransactionAuthorizer
 * @package App\Application\Services\Transaction\AuthorizeTransaction
 */
interface TransactionAuthorizer
{
    /**
     * @return bool
     */
    public function authorize(): bool;
}
